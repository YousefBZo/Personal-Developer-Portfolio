# ===========================================
# Stage 1: Build frontend assets
# ===========================================
FROM node:20-alpine AS node-builder

WORKDIR /app

# Copy package files
COPY package.json package-lock.json* ./

# Install Node dependencies
RUN npm ci

# Copy source files needed for build
COPY resources ./resources
COPY vite.config.js tailwind.config.js postcss.config.js ./

# Build assets
RUN npm run build

# ===========================================
# Stage 2: Build PHP extensions
# ===========================================
FROM php:8.4-cli-alpine AS php-builder

# Use CDN mirror for faster downloads
RUN sed -i 's/dl-cdn.alpinelinux.org/mirrors.aliyun.com/g' /etc/apk/repositories

# Install build dependencies and PHP extensions
RUN apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    postgresql-dev \
    oniguruma-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql pgsql mbstring exif pcntl bcmath gd zip

# ===========================================
# Stage 3: Final PHP Application
# ===========================================
FROM php:8.4-cli-alpine

# Use CDN mirror for faster downloads
RUN sed -i 's/dl-cdn.alpinelinux.org/mirrors.aliyun.com/g' /etc/apk/repositories

# Install only runtime libraries
RUN apk add --no-cache \
    git \
    unzip \
    zip \
    curl \
    libpng \
    libjpeg-turbo \
    freetype \
    postgresql-libs \
    oniguruma \
    libzip

# Copy PHP extensions from builder
COPY --from=php-builder /usr/local/lib/php/extensions/ /usr/local/lib/php/extensions/
COPY --from=php-builder /usr/local/etc/php/conf.d/ /usr/local/etc/php/conf.d/

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy composer files first for better caching
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# Copy the rest of the application
COPY . .

# Copy built assets from node stage
COPY --from=node-builder /app/public/build ./public/build

# Generate optimized autoloader
RUN composer dump-autoload --optimize

# Create storage directories and set permissions
RUN mkdir -p storage/framework/sessions \
    && mkdir -p storage/framework/views \
    && mkdir -p storage/framework/cache \
    && mkdir -p storage/logs \
    && mkdir -p bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Clear config cache (APP_KEY will be provided at runtime via environment)
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear

# Expose port (Render uses PORT env variable, default to 80)
EXPOSE 80

# Start script: generate key if missing, run migrations, cache config, start server
CMD ["sh", "-c", "if [ -z \"$APP_KEY\" ]; then echo 'ERROR: APP_KEY is not set!' && exit 1; fi && php artisan migrate --force && php artisan config:cache && php artisan route:cache && php artisan view:cache && php artisan serve --host=0.0.0.0 --port=${PORT:-80}"]

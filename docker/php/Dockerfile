# ===========================================
# Stage 1: Build stage (install dependencies)
# ===========================================
FROM php:8.4-fpm AS builder

RUN apt update && apt install -y \
    git \
    unzip \
    zip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libpq-dev \
    libonig-dev \
    && apt clean \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

WORKDIR /app

# Copy composer files first for better caching
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# ===========================================
# Stage 2: Production stage (final image)
# ===========================================
FROM php:8.4-fpm AS production

RUN apt update && apt install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libpq-dev \
    libonig-dev \
    && apt clean \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath

# Install Composer (needed for autoload)
COPY --from=builder /usr/local/bin/composer /usr/local/bin/composer

WORKDIR /app

# Copy vendor from builder
COPY --from=builder /app/vendor ./vendor

COPY ./entrypoint.sh /
RUN chmod +x /entrypoint.sh

# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=5s --retries=3 \
    CMD php-fpm-healthcheck || exit 1

ENTRYPOINT [ "/entrypoint.sh" ]

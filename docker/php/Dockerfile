FROM php:8.4-fpm

RUN echo "Bism'ELLEH"


RUN apt update && apt install -y \
    iputils-ping \
    nano \
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

# Install PHP extensions needed for Laravel
RUN docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
 && php -r "if (hash_file('sha384', 'composer-setup.php') === 'c8b085408188070d5f52bcfe4ecfbee5f727afa458b2573b8eaaf77b3419b0bf2768dc67c86944da1544f06fa544fd47') { echo 'Installer verified'.PHP_EOL; } else { echo 'Installer corrupt'.PHP_EOL; unlink('composer-setup.php'); exit(1); }" \
 && php composer-setup.php \
 && php -r "unlink('composer-setup.php');" \
 && mv composer.phar /usr/local/bin/composer

RUN composer --version

RUN mkdir -p /root/.composer \
    && composer global require laravel/installer

# install node (for assets on-demand)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
 && apt-get update \
 && apt-get install -y --no-install-recommends nodejs build-essential \
 && rm -rf /var/lib/apt/lists/*

ENV PATH="/root/.composer/vendor/bin:${PATH}"


WORKDIR /app

COPY ./entrypoint.sh /
RUN chmod +x /entrypoint.sh

ENTRYPOINT [ "/entrypoint.sh" ]

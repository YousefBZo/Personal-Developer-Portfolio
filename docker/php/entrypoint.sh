#!/bin/bash

# For Laravel needed structure and permissions
mkdir -p /app/storage/framework/{sessions,views,cache}
mkdir -p /app/bootstrap/cache

# Set permissions only on directories that need write access
chown -R www-data:www-data /app/storage
chown -R www-data:www-data /app/bootstrap/cache
chmod -R 775 /app/storage
chmod -R 775 /app/bootstrap/cache

#copy .env from .env.example
if [ ! -f .env ]; then
  cp .env.example .env
fi

# Start PHP-FPM
php-fpm

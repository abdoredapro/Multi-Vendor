#!/bin/bash

set -e

# Check if .env not exists
if [ ! -f .env ]; then
    cp .env.example .env
fi

composer install --no-dev --no-interaction --optimize-autoloader

# Run migrations
php artisan migrate --force

echo "🧹 Clearing and caching Laravel..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache

exec php-fpm

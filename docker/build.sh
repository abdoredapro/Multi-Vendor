#!/bin/bash

set -e

# Check if .env not exists
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Run migrations
php artisan migrate --force

exec php-fpm

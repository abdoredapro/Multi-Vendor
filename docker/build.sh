#!/bin/bash

set -e

# Check if .env not exists
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Check if composer not exists
composer update --no-dev --optimize-autoloader

# Run migrations
php artisan migrate --force

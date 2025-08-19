#!/bin/bash
set -e  

# تثبيت dependencies
composer install --no-dev --optimize-autoloader

php artisan migrate --force

echo "Build completed successfully!"
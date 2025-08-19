#!/bin/bash

echo "Start polling for changes"

git pull origin main

echo "📦 Installing composer dependencies..."
composer install --no-dev --optimize-autoloader

echo "🛠 Running migrations..."
php artisan migrate --force

echo "🧹 Clearing and caching Laravel..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache

echo "🐳 Rebuilding Docker containers..."
docker compose down
docker compose up -d --build

echo "✅ Deployment finished!"


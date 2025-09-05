#!/bin/bash
set -e

cd ~/multi_vendor_backend

CURRENT=$(docker ps --format '{{.Names}}' | grep -E 'php_blue|php_green' || true)

if [[ "$CURRENT" == *"php_blue"* ]]; then
    NEW="php_green"
    OLD="php_blue"
else
    NEW="php_blue"
    OLD="php_green"
fi

echo "📡 Pulling latest code..."
git pull origin main

echo "🐳 Building new container: $NEW..."
docker compose build $NEW
docker compose up -d $NEW

echo "🔍 Waiting for $NEW to be ready..."
sleep 10
docker exec -it $NEW php artisan migrate --force || true

echo "🔀 Switching Nginx to $NEW..."

sed -i "s/$OLD:9000;/$NEW:9000;/" docker/nginx.conf

docker compose exec nginx nginx -s reload

echo "🧹 Stopping old container: $OLD..."
docker compose stop $OLD

echo "✅ Deployment finished! Now running: $NEW"

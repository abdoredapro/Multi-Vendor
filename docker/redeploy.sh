#!/bin/bash

cd multi_vendor_backend/

echo "📡 Pulling from GitHub..."
git pull origin main

echo "🐳 Rebuilding Docker containers..."
docker compose down
docker compose up -d --build

echo "✅ Deployment finished!"


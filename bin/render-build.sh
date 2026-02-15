#!/usr/bin/env bash
# exit on error
set -o errexit

echo "Installing composer dependencies..."
composer install --no-dev --optimize-autoloader

echo "Installing npm dependencies and building assets..."
npm install
npm run build

echo "Caching configuration..."
php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache

echo "Running migrations..."
php artisan migrate --force

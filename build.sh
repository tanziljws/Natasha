#!/bin/bash
set -e

# Install PHP extensions yang diperlukan
install-php-extensions gd bcmath || true

# Install composer dependencies dengan ignore platform requirements untuk extensions yang optional
composer install --optimize-autoloader --no-scripts --no-interaction --ignore-platform-req=ext-gd --ignore-platform-req=ext-bcmath || \
composer install --optimize-autoloader --no-scripts --no-interaction

# Install npm dependencies
npm ci

# Build assets
npm run build

# Setup Laravel
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true


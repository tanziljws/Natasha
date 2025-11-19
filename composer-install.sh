#!/bin/bash
set -e

# Install PHP extensions yang diperlukan
echo "Installing PHP extensions: gd, bcmath"
install-php-extensions gd bcmath || echo "Warning: Could not install extensions, continuing..."

# Install composer dependencies dengan ignore platform requirements
echo "Installing composer dependencies..."
composer install --optimize-autoloader --no-scripts --no-interaction --ignore-platform-req=ext-gd --ignore-platform-req=ext-bcmath

echo "Composer install completed!"


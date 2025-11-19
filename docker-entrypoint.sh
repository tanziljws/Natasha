#!/bin/sh
set -e

# Create storage directories if they don't exist
mkdir -p storage/app/public/ckeditor
mkdir -p storage/app/public/foto
mkdir -p storage/app/public/major
mkdir -p storage/app/public/ui-config

# Create storage symlink if it doesn't exist
if [ ! -L public/storage ]; then
    php artisan storage:link || ln -sf /var/www/storage/app/public /var/www/public/storage
fi

# Set proper permissions
chmod -R 775 storage/app/public

# Get PORT from environment or use default
PORT=${PORT:-8000}

# Ensure PORT is a number
PORT=$(echo "$PORT" | grep -E '^[0-9]+$' || echo "8000")

# Start Laravel server
exec php artisan serve --host=0.0.0.0 --port="$PORT"


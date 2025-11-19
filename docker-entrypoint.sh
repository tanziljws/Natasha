#!/bin/sh
set -e

# Get PORT from environment or use default
PORT=${PORT:-8000}

# Ensure PORT is a number
PORT=$(echo "$PORT" | grep -E '^[0-9]+$' || echo "8000")

# Start Laravel server
exec php artisan serve --host=0.0.0.0 --port="$PORT"


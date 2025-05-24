#!/bin/sh
set -e

# Run Laravel migrations and cache config/routes/views for production
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache

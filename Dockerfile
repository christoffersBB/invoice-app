# Use official PHP image with FPM
FROM php:8.2-fpm

# Install system dependencies, PHP extensions, and Node.js
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    nginx \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application code
COPY . /var/www/html

# Copy Nginx configuration
COPY docker/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf

# Remove default Nginx site config
RUN rm /etc/nginx/sites-enabled/default || true

# Clean vendor directory and composer.lock before install
RUN rm -rf /var/www/html/vendor /var/www/html/composer.lock \
    && composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Install Node.js dependencies and build Tailwind CSS assets
RUN npm install && npm run build

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Set environment variables for Laravel
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr

# Copy and execute deploy script
COPY scripts/00-laravel-deploy.sh /00-laravel-deploy.sh
RUN chmod +x /00-laravel-deploy.sh

# Expose port 80 for Render
EXPOSE 80

# Start Nginx and PHP-FPM after running deploy script
CMD /00-laravel-deploy.sh && service nginx start && php-fpm

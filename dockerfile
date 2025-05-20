FROM php:8.2-apache

# Install system dependencies including PostgreSQL support, nodejs and npm
RUN apt-get update && apt-get install -y \
    zip unzip curl libzip-dev libonig-dev libpq-dev \
    nodejs npm \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set document root to /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Apply the new document root
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/000-default.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node.js dependencies and build assets for Vite
RUN npm install && npm run build && npm run dev

# Prepare Laravel
RUN cp .env.example .env \
    && php artisan key:generate \
    && php artisan config:cache

EXPOSE 80

# Run migrations, seed DB, then start Apache
CMD php artisan migrate --force && php artisan db:seed --force && apache2-foreground

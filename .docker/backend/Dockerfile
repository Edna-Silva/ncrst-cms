FROM php:8.2-fpm

# Install PHP extensions and system dependencies
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libpq-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Composer install
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy existing app
COPY ./whimsical-website-backend /var/www/html

# Install PHP dependencies
RUN composer install

# Set permissions
RUN chown -R www-data:www-data /var/www/html

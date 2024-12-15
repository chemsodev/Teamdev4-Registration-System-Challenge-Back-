# Use an official PHP runtime as a parent image
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    libzip-dev \
    && docker-php-ext-install pdo_mysql zip gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application source
COPY . /var/www/html

# Install application dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Copy the custom PHP-FPM configuration
# Ensure you have a valid path to the www.conf file
COPY ./config/www.conf /usr/local/etc/php-fpm.d/www.conf

# Expose port 8080 for your application
EXPOSE 8080

# Start PHP-FPM in the foreground
CMD ["php-fpm", "-F"]

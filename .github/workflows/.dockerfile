# Use the official PHP image as a base
FROM php:8.1-apache

# Set the working directory
WORKDIR /var/www/html

# Copy the local PHP application to the container
COPY . .

# Install any necessary PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer for dependency management
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install project dependencies using Composer
RUN composer install --no-dev --optimize-autoloader

# Set permissions for the Apache server
RUN chown -R www-data:www-data /var/www/html

# Enable Apache rewrite module for clean URLs
RUN a2enmod rewrite

# Set environment variables
ENV APP_ENV=production
ENV APP_DEBUG=false

# Copy Apache virtual host configuration
COPY ./docker/apache/vhost.conf /etc/apache2/sites-available/000-default.conf

# Expose port 80 for the web server
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
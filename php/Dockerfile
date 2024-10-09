FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nano \
    git \
    curl
#    curl && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ENV COMPOSER_ALLOW_SUPERUSER=1

COPY php.ini /usr/local/etc/php/conf.d/php.ini

# RUN git clone https://github.com/Dzheb/Reka.git /var/www/html

# ADD https://github.com/Dzheb/Reka.git /var/www/html
# RUN git clone https://github.com/Dzheb/Reka.git /var/www/html/Reka
# Set working directory
# WORKDIR /var/www/html
# WORKDIR /var/www/html/Reka

# Set permissions
# RUN chown -R www-data:www-data /var/www/html/ \
# && chmod -R 777 /var/www/html/
# RUN chown -R www-data:www-data /var/www/html/Reka/ \
# && chmod -R 777 /var/www/html/Reka/
# Expose port 9000 for PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]

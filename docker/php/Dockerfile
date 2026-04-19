FROM php:8.1-fpm

COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer
COPY php.ini /usr/local/etc/php/

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql zip

WORKDIR /var/www/html
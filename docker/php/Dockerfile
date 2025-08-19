FROM php:8.3-fpm

# Extensiones necesarias
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libonig-dev libxml2-dev libzip-dev libpq-dev wget supervisor \
 && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath opcache zip

# Opcional: intl
RUN apt-get install -y libicu-dev && docker-php-ext-install intl

# Opcional: redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# php.ini
COPY php.ini /usr/local/etc/php/conf.d/php.ini

WORKDIR /var/www/html

# Permisos para storage/bootstrap
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

# Supervisor base (queue/horizon)
RUN mkdir -p /var/log/supervisor
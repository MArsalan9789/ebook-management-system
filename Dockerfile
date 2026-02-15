FROM php:8.2-apache

RUN apt-get update && apt-get install -y libzip-dev unzip git curl \
    && docker-php-ext-install pdo_mysql zip

RUN a2enmod rewrite

WORKDIR /var/www/html

COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

EXPOSE 10000

CMD ["apache2-foreground"]

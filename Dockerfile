FROM php:7.4-fpm
ENV COMPOSER_ALLOW_SUPERUSER 1

RUN apt-get update && apt-get upgrade -y
RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev libzip-dev libonig-dev libxml2-dev git unzip

# Cài đặt các extension cần thiết
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . /var/www

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache && \
    chmod -R 775 /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000
USER www-data

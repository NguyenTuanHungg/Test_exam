FROM php:7.4-fpm

RUN apt-get update && apt-get upgrade -y
RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev libzip-dev libonig-dev libxml2-dev
# Cài đặt các extension cần thiết
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . /var/www

RUN composer install

CMD php artisan serve --host=0.0.0.0 --port=8000

EXPOSE 8000
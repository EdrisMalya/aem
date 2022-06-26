FROM php:8.0.11
FROM composer:2.1.10

WORKDIR /app
COPY composer.json composer.lock ./

RUN composer install
COPY . .

CMD php artisan serve --host=0.0.0.0
EXPOSE 8000

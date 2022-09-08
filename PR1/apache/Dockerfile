FROM php:8.0-apache
EXPOSE 80

WORKDIR /var/www/html/
COPY . .

RUN docker-php-ext-install mysqli
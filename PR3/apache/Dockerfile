FROM php:8.0-apache
EXPOSE 80

WORKDIR /var/www/html/
COPY pages .
COPY 000-default.conf /etc/apache2/sites-available/

RUN docker-php-ext-install mysqli && \
    a2enmod authn_dbd && \
    apt-get update && \
    apt-get install -y libaprutil1-dbd-mysql && \
    service apache2 restart
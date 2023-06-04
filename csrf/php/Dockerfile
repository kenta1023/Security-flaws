FROM php:8.1-apache
RUN docker-php-ext-install pdo_mysql 
RUN a2enmod headers
COPY apache2.conf /etc/apache2/apache2.conf
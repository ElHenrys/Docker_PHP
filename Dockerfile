FROM php:8.2-apache

# Instalar la extensión PDO MySQL
RUN docker-php-ext-install pdo_mysql

WORKDIR /var/www/html
COPY . /var/www/html

EXPOSE 80

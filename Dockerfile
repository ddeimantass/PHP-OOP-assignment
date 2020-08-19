FROM php:7.4-apache

RUN apt-get update && apt-get upgrade -y && apt-get install -y git libzip-dev unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 80

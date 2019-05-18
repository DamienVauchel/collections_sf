FROM php:7.3-fpm
MAINTAINER Damien Vauchel <damien.vauchel@gmail.com>

RUN apt-get update && apt-get install -y zip git nano openssl sqlite libsqlite3-dev libzip-dev

# Install PHP extensions
RUN apt-get install -y libpng-dev zlib1g-dev && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install mbstring pdo pdo_mysql gd zip pdo_sqlite

EXPOSE 9000

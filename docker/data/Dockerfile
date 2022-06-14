FROM php:8.0.20-fpm-buster

WORKDIR /app

RUN apt-get update && apt-get install -y --no-install-recommends \
    git sudo cron \
    libjpeg62-turbo-dev libfreetype6-dev libmcrypt-dev libzip-dev libc-client-dev libkrb5-dev libxml2-dev libpq-dev \
 && apt-get clean

RUN docker-php-ext-configure gd --with-jpeg --with-freetype \
 && nice docker-php-ext-install -j$(nproc) gd zip opcache pdo_mysql pdo_pgsql tokenizer pcntl \
 && nice pecl install redis && docker-php-ext-enable redis

# Composer
RUN curl -O https://getcomposer.org/installer && \
    php installer --filename=composer --install-dir=/usr/local/bin && \
    rm installer

FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    libpq-dev \
    wget \
    zlib1g-dev \
    libmcrypt-dev \
    libzip-dev \
    libxml2-dev \
    libsodium-dev \
    libfreetype-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libcurl4 \
    libcurl4-openssl-dev

ENV PHP_CS_FIXER_IGNORE_ENV=1

RUN docker-php-ext-install zip sodium bcmath curl

COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer self-update

RUN pecl install xdebug-3.3.2 && docker-php-ext-enable xdebug
COPY conf/xdebug.ini /usr/local/etc/php/conf.d/

WORKDIR /app
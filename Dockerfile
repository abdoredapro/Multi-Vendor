FROM php:8.3-fpm-alpine

RUN RUN apk add --no-cache icu-dev ...  \
    icu-dev \
    oniguruma-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libwebp-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) pdo_mysql zip bcmath exif opcache intl gd


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

# 1- انسخ بس composer.json
COPY composer.json composer.lock /var/www/

# 2- اعمل install
RUN composer install --no-dev --no-scripts --prefer-dist --no-interaction

# 3- انسخ باقي الملفات
COPY . /var/www

USER multi_vendor

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

RUN chmod +x docker/build.sh

ENTRYPOINT [ "sh", "docker/build.sh" ]

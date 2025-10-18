FROM php:8.3-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    icu-dev \
    oniguruma-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libwebp-dev \
    zip \
    unzip \
    bash \
    autoconf \
    g++ \
    make \
    pkgconf \
    git \
    curl \
    supervisor \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) pdo_mysql zip bcmath exif opcache intl gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

COPY composer.json composer.lock /var/www/

RUN composer install --no-dev --no-scripts --prefer-dist --no-interaction

COPY . /var/www

RUN mkdir -p /var/www/storage /var/www/bootstrap/cache \
    && chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Copy supervisor config file (you’ll create it next)
COPY docker/supervisord.conf /etc/supervisord.conf

# Make sure your custom script is executable
RUN chmod +x docker/build.sh

# Start supervisor when container starts
ENTRYPOINT ["/var/www/docker/build.sh"]

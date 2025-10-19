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

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www

# Copy only composer files first (for build caching)
COPY composer.json composer.lock ./

# Create empty vendor folder to avoid autoload error if composer fails
RUN mkdir -p vendor

# Install PHP dependencies
RUN composer install --no-dev --no-scripts --prefer-dist --no-interaction || true

# Copy full project
COPY . .

# Fix permissions
RUN mkdir -p /var/www/storage /var/www/bootstrap/cache /var/log/nginx \
    && chown -R www-data:www-data /var/www /var/log/nginx \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Copy supervisor config file
COPY docker/supervisord.conf /etc/supervisord.conf

# Make build script executable (only if it exists)
RUN chmod +x /var/www/docker/build.sh || true

# Start supervisor on container startup
ENTRYPOINT ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]

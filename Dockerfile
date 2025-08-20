FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    libfreetype-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    unzip \
    libicu-dev \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql zip intl

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# نسخ ملفات المشروع قبل git config
COPY . .

# ضبط الأذونات
RUN chown -R www-data:www-data /var/www/html \
    && chmod +x docker/build.sh \
    && git config --global --add safe.directory /var/www/html

# تثبيت composer
RUN composer install --prefer-dist --no-dev --no-interaction --optimize-autoloader

# تشغيل السكربت
ENTRYPOINT ["sh", "/var/www/html/docker/build.sh"]

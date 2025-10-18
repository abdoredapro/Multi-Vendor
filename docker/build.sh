#!/bin/sh

cd /var/www

php artisan storage:link
php artisan package:discover --ansi
# php artisan vendor:publish --tag=laravel-assets --ansi --force

chmod 777 /var/www/bootstrap/cache
chmod -R 775 /var/www/storage
chown -R www:www-data .

php artisan migrate --force

/usr/bin/supervisord -c /etc/supervisord.conf

php artisan optimize
#!/bin/sh

php /var/www/html/artisan view:clear;
php /var/www/html/artisan route:clear;
php /var/www/html/artisan config:clear;
php /var/www/html/artisan cache:clear;
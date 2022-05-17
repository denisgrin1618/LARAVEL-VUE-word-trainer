#!/bin/sh

sleep 30

composer install;
composer dump-autoload;
php /var/www/artisan migrate --seed;

# FIXME
npm install --silent
npm run dev
chmod 777 -R public/js

php artisan storage:link

crond -f

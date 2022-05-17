FROM php:8.1-fpm

# Copy composer.lock and composer.json into the working directory
# COPY composer.lock composer.json /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Install dependencies for the operating system software
RUN apt-get update && apt-get install -y \
    cron \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    libzip-dev \
    unzip \
    git \
    libonig-dev \
    curl \
    supervisor

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions for php
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl gd
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

# Install composer (php package manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing application directory contents to the working directory
# COPY . /var/www/html
COPY laravel.ini /usr/local/etc/php/conf.d/laravel.ini

# Assign permissions of the working directory to the www-data user
# RUN chown -R www-data:www-data \
#     /var/www/html/storage \
#     /var/www/html/bootstrap/cache








# Add docker php ext repo
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Install php extensions
# RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
#     install-php-extensions mbstring pdo_mysql zip exif pcntl gd memcached

# Install supervisor
# RUN apt-get install -y supervisor

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD supervisord.conf /etc/supervisor/
ADD /scripts/*.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/*.sh 

# Expose port 9000 and start php-fpm server (for FastCGI Process Manager)
# EXPOSE 9000
# CMD ["php-fpm"]


RUN crontab -l | { cat; echo "* * * * * /usr/local/bin/php /var/www/artisan schedule:run >> /var/log/cron.log 2>&1"; } | crontab -

EXPOSE 9000
CMD ["supervisord", "-c", "/etc/supervisor/supervisord.conf"]
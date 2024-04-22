FROM php:7.4-fpm

COPY . /var/www/html
WORKDIR /var/www/html

RUN apt-get update -y
RUN apt-get install -y zip unzip git libonig-dev zlib1g-dev libpng-dev libzip-dev libpq-dev
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
RUN docker-php-ext-install zip pdo mbstring gd pgsql pdo_pgsql pdo_mysql mysqli

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -G www,www-data,root masbro

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN composer install
COPY --chown=www:www . .

USER masbro

EXPOSE 9001

CMD [ "php-fpm" ]

# CMD ["php", "artisan", "serve"]

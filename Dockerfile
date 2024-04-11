FROM php:8.2-fpm
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    libzip-dev \
    libpq-dev \
    nodejs \
    npm \
    && docker-php-ext-install pdo_pgsql zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

WORKDIR /var/www/html

RUN composer install --no-scripts
RUN npm install && npm run build

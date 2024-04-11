FROM php:8.2-fpm

ARG user=library
ARG uid=1000

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

RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

WORKDIR /var/www/html
RUN chown -R www-data:www-data storage bootstrap/cache
RUN composer install --no-scripts
RUN npm install && npm run build

USER $user
CMD ["php-fpm"]

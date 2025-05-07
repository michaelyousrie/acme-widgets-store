# Dockerfile
FROM php:8.2-cli

WORKDIR /var/www/html/

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY . .

RUN composer install

CMD [ "composer", "start" ]
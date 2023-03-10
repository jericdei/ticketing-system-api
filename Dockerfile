FROM php:8.2-fpm-alpine

ARG uid
ARG user

RUN apk add --no-cache shadow postgresql-dev
RUN docker-php-ext-install pdo pdo_pgsql

RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && chown -R $user:$user /home/$user
RUN chown -R $user:$user /var/www

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
USER $user


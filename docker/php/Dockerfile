FROM php:7.3-fpm-alpine3.9

ARG USER_ID=1000
ARG GROUP_ID=1000

WORKDIR /var/www/html

RUN apk add --no-cache $PHPIZE_DEPS \

    # Создаём такого же пользователя, как и на хосте
    && addgroup -S $GROUP_ID && adduser -S $USER_ID -G $GROUP_ID \

    # Устанавливаем расишрения php
    && apk --no-cache add postgresql-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && pecl install redis-4.0.1 \
    && pecl install xdebug-2.7.2 \
    && docker-php-ext-enable redis xdebug pdo pdo_pgsql pgsql \

    # Git
    && apk update \
    && apk add git \

    # Устанавливаем composer
    && echo "Устанавливаем composer" \
    && wget https://getcomposer.org/download/1.10.1/composer.phar -O /usr/local/bin/composer \
    && chmod +x /usr/local/bin/composer

USER $USER_ID

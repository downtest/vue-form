ARG USER_ID
ARG GROUP_ID

FROM php:7.3-fpm-alpine3.9

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
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('sha384', 'composer-setup.php') === 'a5c698ffe4b8e849a443b120cd5ba38043260d5c4023dbf93e1558871f1f07f58274fc6f4c93bcfd858c6bd0775cd8d1') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer \
    && cd /var/www/html 
 
USER $USER_ID

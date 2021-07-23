FROM php:8.0.3-fpm-alpine3.13 AS php-fpm
WORKDIR /var/www/html
RUN apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
    && apk add --no-cache \
    && pecl install redis \     
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        bcmath \
        opcache \
    && apk del -f .build-deps \
    && docker-php-ext-enable \
       pdo_mysql \
       redis                    


FROM php:8.0.3-cli-alpine3.13 AS worker
WORKDIR /var/www/html
RUN apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
    && apk add --no-cache \
    && pecl install redis \     
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        bcmath \
    && apk del -f .build-deps \
    && docker-php-ext-enable \
       pdo_mysql \
       redis          
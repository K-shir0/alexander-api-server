FROM php:7.4-fpm-alpine

RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer

RUN docker-php-ext-install pdo_mysql

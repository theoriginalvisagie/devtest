FROM php:8.2-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql fileinfo gettext

RUN docker-php-ext-enable mysqli pdo pdo_mysql fileinfo gettext

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN a2enmod rewrite

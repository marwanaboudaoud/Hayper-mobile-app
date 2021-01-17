FROM php:7.2-fpm-alpine

RUN apk update && apk add bash && apk add libpng-dev
RUN docker-php-ext-install pdo pdo_mysql gd
RUN apk add --no-cache libzip-dev && docker-php-ext-configure zip --with-libzip=/usr/include && docker-php-ext-install zip
RUN apk add libxml2-dev && docker-php-ext-install soap

#Add a user so we run in non-root mode
RUN addgroup -g 1001 -S appuser && adduser -u 1001 -S appuser -G appuser
RUN mkdir -p /var/www/app && chown -R appuser:appuser /var/www/app
RUN mkdir /logs && chown -R appuser:appuser /logs

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/app

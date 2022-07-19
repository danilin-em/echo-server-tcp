FROM php:7.4-cli-alpine

ENV LISTEN_PORT=9900

WORKDIR /var/www/html

RUN docker-php-ext-install sockets \
    && docker-php-ext-enable sockets

COPY ./echo-server.php ./

CMD php echo-server.php

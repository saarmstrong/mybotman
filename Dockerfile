FROM php:7.1

RUN apt-get update \
    && apt-get install -y wget \
    git \
    zip

# install composer
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/bin/composer

ADD index.php /var/www/
ADD composer.json /var/www/

RUN cd /var/www && composer install

# run PHP server
CMD php -S 0.0.0.0:80 -t /var/www

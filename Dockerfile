FROM ubuntu:16.04


RUN apt update
RUN apt install -y memcached nginx php-fpm php-xml composer
RUN apt install -y mc bash-completion curl git
RUN rm /etc/nginx/sites-enabled/*
RUN apt clean

WORKDIR /var/www
ADD composer.json /var/www
RUN composer --no-dev --prefer-stable update

ADD *.php /var/www/
ADD Demo /var/www/Demo
ADD dat /var/www/dat
ADD img /var/www/img

RUN chown -R www-data:www-data /var/www

ADD nginx.conf /etc/nginx/sites-enabled/

WORKDIR /tmp
ADD entrypoint.sh /tmp
ENTRYPOINT /tmp/entrypoint.sh
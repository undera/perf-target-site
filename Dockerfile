FROM ubuntu:16.04


RUN apt update
RUN apt install -y memcached nginx composer php-fpm php-xml php-memcached
RUN apt install -y mc bash-completion curl git
RUN rm /etc/nginx/sites-enabled/*
RUN apt clean

WORKDIR /var/www
ADD composer.json /var/www
RUN composer --no-dev --prefer-stable update && ln -s vendor/undera/pwe/index.php && ln -s vendor/undera/pwe/.htaccess

ADD *.php /var/www/
ADD Demo /var/www/Demo
ADD dat /var/www/dat
ADD img /var/www/img

RUN chown -R www-data:www-data /var/www

RUN apt install -y
ADD nginx.conf /etc/nginx/sites-enabled/
ADD php.ini /etc/php/7.0/fpm/conf.d/99-perf-target.ini

WORKDIR /tmp
ADD entrypoint.sh /tmp
ENTRYPOINT /tmp/entrypoint.sh
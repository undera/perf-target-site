#!/bin/sh -xe

service memcached start
service php7.0-fpm start
service nginx start
ps auxff
curl -v http://localhost
#top
bash
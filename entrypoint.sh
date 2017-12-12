#!/bin/sh -xe

service memcached start
service nginx start
ps auxff
curl -v http://localhost
top
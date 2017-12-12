FROM ubuntu:16.04

RUN apt update
RUN apt install -y curl memcached nginx
RUN apt clean

ADD entrypoint.sh /root

ENTRYPOINT /root/entrypoint.sh
#!/bin/sh -xe
sudo docker build -t perf-target .
#x-www-browser http://localhost:8089 &
sudo docker run -p 8089:80 -it perf-target

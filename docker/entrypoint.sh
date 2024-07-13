#!/usr/bin/env bash

# change working directory to application
cd /app
# reset database to default
php bin/app capito:mock:reset -y
# start the built-in server listening on port 80
php -S 0.0.0.0:80 -t ./public/

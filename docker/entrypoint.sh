#!/usr/bin/env bash

# change working directory to application
cd /var/www
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
chmod a+x composer.phar
composer.phar install
# reset database to default
php bin/app capito:mock:reset -y
# start the built-in server listening on port 80
php -S 0.0.0.0:80 -t ./public/

FROM composer:2.7

# set workdir to default server
WORKDIR /var/www
COPY . .
EXPOSE 80
RUN composer install

ENTRYPOINT [ "docker/entrypoint.sh" ]

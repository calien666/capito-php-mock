FROM php:8.3

# set workdir to default server
WORKDIR /var/www
COPY . .

ENTRYPOINT [ "docker/entrypoint.sh" ]

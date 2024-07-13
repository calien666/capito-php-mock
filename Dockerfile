FROM php:8.3

# set workdir to default server
WORKDIR /app
COPY . .

ENTRYPOINT [ "docker/entrypoint.sh" ]

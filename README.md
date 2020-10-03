# PHP gRPC Example
## requires
- php
- composer
- pecl/grpc # for client.php
- docker
- docker-compose
### no local php & composer
```shell script
# after setup
docker run --rm -it -v ${PWD}:/app composer {COMMANDS}
```

## setup
```shell script
docker-compose pull
docker-compose build
composer init-config
generate-protobuf.sh
# for windows: wsl ./generate.sh
```

## execute
```shell script
docker-compose up -d
```

## commands
```shell script
composer reset-workers
composer show-workers
# 
php client.php
```

## reference
https://github.com/n1215/roadrunner-docker-skeleton/blob/master/README.md

FROM php:7.4-cli as base

RUN apt-get update \
  && apt-get install -y --no-install-recommends \
    vim \
    libzip-dev \
    unzip \
  && docker-php-ext-install \
    zip \
    opcache \
    sockets \
  && docker-php-ext-enable \
    opcache

# Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer config -g repos.packagist composer https://packagist.jp \
  && composer global require hirak/prestissimo

# Download RoadRunner-grpc
RUN curl -L -O https://github.com/spiral/php-grpc/releases/download/v1.4.0/rr-grpc-1.4.0-linux-amd64.tar.gz \
  && tar zxf rr-grpc-1.4.0-linux-amd64.tar.gz \
  && rm rr-grpc-1.4.0-linux-amd64.tar.gz \
  && mv rr-grpc-1.4.0-linux-amd64/rr-grpc /usr/local/bin \
  && rm -Rf rr-grpc-1.4.0-linux-amd64

# Download RoadRunner
ENV RR_VERSION 1.8.3
RUN mkdir /tmp/rr \
  && cd /tmp/rr \
  && echo "{\"require\":{\"spiral/roadrunner\":\"${RR_VERSION}\"}}" >> composer.json \
  && composer install \
  && vendor/bin/rr get-binary -l /usr/local/bin \
  && rm -rf /tmp/rr

# Copy RoadRunner config
COPY config /etc/roadrunner

WORKDIR /var/www

ENTRYPOINT ["/usr/local/bin/rr", "serve", "-d", "-c", "/etc/roadrunner/.rr.yaml"]

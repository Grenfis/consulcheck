FROM php:7.4-fpm-alpine

RUN apk upgrade --update

RUN apk add --no-cache \
    postgresql-dev \
    busybox-suid \
    curl-dev \
    oniguruma-dev \
    unzip \
    icu-dev

RUN docker-php-ext-install \
  intl \
  bcmath \
  opcache \
  pdo \
  pgsql \
  pdo_pgsql \
  mbstring

RUN apk add --no-cache \
      freetype \
      libjpeg-turbo \
      libpng \
      freetype-dev \
      libjpeg-turbo-dev \
      libpng-dev \
    && docker-php-ext-configure gd \
      --with-freetype=/usr/include/ \
      --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-enable gd \
    && apk del --no-cache \
      freetype-dev \
      libjpeg-turbo-dev \
      libpng-dev

EXPOSE 9000
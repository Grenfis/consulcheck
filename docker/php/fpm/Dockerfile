FROM php:7.4-fpm-alpine

ENV USER_ID=1000
ENV GROUP_ID=1000

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
  pdo_mysql \
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

RUN apk add --no-cache \
  libzip-dev \
  zip \
  && docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

RUN mkdir -p /var/www/php/logs  \
    && mkdir -p /var/www/php/captchas  \
    && mkdir -p /var/www/php/available_places \
    && mkdir -p /var/www/php/logs

COPY ./app /var/www/php/
COPY ./composer* /var/www/php/
COPY ./phinx.php /var/www/php/
COPY ./db /var/www/php/

COPY ./docker/php/php.ini /usr/local/etc/php/php.ini
COPY ./docker/php/fpm/pool.d/app.conf /usr/local/etc/php-fpm.d/app.conf

RUN cd /var/www/php && composer install && composer  dump-autoload

EXPOSE 9000
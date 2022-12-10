FROM php:7.4-cli-alpine

ARG SUPERCRONIC_VERSION
ARG SUPERCRONIC_SHA1SUM
ARG APP_PATH

# From https://github.com/aptible/supercronic/releases
ENV SUPERCRONIC_URL=https://github.com/aptible/supercronic/releases/download/v${SUPERCRONIC_VERSION}/supercronic-linux-amd64 \
    SUPERCRONIC=supercronic-linux-amd64 \
    SUPERCRONIC_SHA1SUM=${SUPERCRONIC_SHA1SUM}

RUN apk upgrade --update

RUN apk add --no-cache \
    bash \
    nano \
    busybox-suid \
    curl-dev \
    oniguruma-dev \
    unzip \
    git \
    icu-dev

RUN docker-php-ext-install \
  intl \
  bcmath \
  opcache \
  pdo \
  pdo_mysql \
  mbstring

RUN apk add --no-cache \
  libzip-dev \
  zip \
  && docker-php-ext-install zip

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
      libpng-dev \
    && rm -rf /tmp/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

RUN apk add --no-cache \
    tini \
    ca-certificates \
    && curl -fsSLO "$SUPERCRONIC_URL" \
    && echo "${SUPERCRONIC_SHA1SUM}  ${SUPERCRONIC}" | sha1sum -c - \
    && chmod +x "$SUPERCRONIC" \
    && mv "$SUPERCRONIC" "/usr/local/bin/${SUPERCRONIC}" \
    && ln -s "/usr/local/bin/${SUPERCRONIC}" /usr/local/bin/supercronic \
    && apk del --purge \
           ca-certificates

RUN rm -rf /var/cache/apk/
RUN docker-php-source delete

WORKDIR ${APP_PATH}

#RUN curl -sS https://getcomposer.org/installer | php -- \
#  --install-dir=/usr/bin --filename=composer && chmod +x /usr/bin/composer

#COPY ./app /var/www/php/app
#COPY ./composer.json /var/www/php/composer.json
#COPY ./composer.lock /var/www/php/composer.lock
#
#RUN cd /var/www/php  \
#    && composer install \
#   --no-interaction \
#   --prefer-dist \
#    && composer dump-autoload

#ENTRYPOINT ["/sbin/tini", "--"]

CMD ["/usr/local/bin/supercronic", "/etc/crontabs/crontab"]

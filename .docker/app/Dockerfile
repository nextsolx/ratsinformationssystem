FROM debian:stretch-slim as runtime

ENV PATH="./vendor/bin:${PATH}" \
    NGINX_SERVER_NAME="_" \
    PHP_OPCACHE_VALIDATE_TIMESTAMPS="0" \
    PHP_OPCACHE_MAX_ACCELERATED_FILES="6000" \
    PHP_OPCACHE_MEMORY_CONSUMPTION="128"

ARG USER_UID=33
ARG USER_GID=33

# common packages
RUN apt-get update && apt-get install -y runit nginx-light netcat unzip curl gnupg apt-transport-https && \
rm -rf /var/lib/apt/lists/*

# php and modules
RUN curl -s https://packages.sury.org/php/apt.gpg | apt-key add -\
 && echo "deb https://packages.sury.org/php/ stretch main" > /etc/apt/sources.list.d/php.list \
 && apt-get update && apt-get install -y php7.2-curl php7.2-fpm php7.2-zip\
 php7.2-dom php7.2-mbstring php7.2-intl php7.2-mysql php7.2-bcmath php7.2-gd php7.2-apcu\
 php-imagick && apt-get autoremove -y && rm -rf /var/lib/apt/lists/*

# overlay
ADD .docker/app/overlay /

# imagemagick and ffmpeg deps and checks
RUN apt-get update -qq && apt-get install -y -t unstable libheif-dev libfftw3-dev \
 && rm -rf /var/lib/apt/lists/*

# working dir and ownership
RUN echo $USER_UID
RUN echo $USER_GID
RUN chown -R www-data:www-data /var/www
RUN /usr/local/bin/changeowner.sh www-data $USER_UID $USER_GID
WORKDIR /var/www/html

# startup
ENTRYPOINT ["/usr/local/bin/run-app.sh"]

CMD ["/usr/bin/runsvdir", "-P", "/etc/service"]

# ---------------------

FROM runtime as develop

# env and args
ARG COMPOSER_AUTH
ENV COMPOSER_AUTH=$COMPOSER_AUTH
ARG REGISTRY_NPMJS_ORG_TOKEN
ENV REGISTRY_NPMJS_ORG_TOKEN=$REGISTRY_NPMJS_ORG_TOKEN
ARG APP_URL
ENV APP_URL=$APP_URL
ARG MIX_FLEXBOX_URL
ENV MIX_FLEXBOX_URL=$MIX_FLEXBOX_URL

# composer
RUN /usr/local/bin/composer-installer.sh\
 && mv composer.phar /usr/local/bin/composer\
 && chmod +x /usr/local/bin/composer\
 && composer --version

# xdebug
RUN apt-get update && apt-get install -o Dpkg::Options::="--force-confold" -y php-xdebug\
 && phpenmod -v 7.2 -s cli xdebug\
 && phpenmod -v 7.2 -s fpm xdebug

# nodejs / yarn
RUN curl -s https://deb.nodesource.com/gpgkey/nodesource.gpg.key | apt-key add -\
 && echo 'deb https://deb.nodesource.com/node_8.x stretch main' > /etc/apt/sources.list.d/nodesource.list\
 && apt-get update && apt-get install -y nodejs && npm install -g yarn && rm -rf /var/lib/apt/lists/*

RUN install -o www-data -g www-data -d /var/www/.cache/
RUN install -o www-data -g www-data -d /var/www/.cache/yarn
RUN install -o www-data -g www-data -d /var/www/.composer

# ----------------------------

FROM develop as php-builder
COPY --chown=www-data:www-data . /var/www/html
USER www-data
RUN composer install --no-dev --prefer-dist --optimize-autoloader

# --------------------------

FROM develop as node-builder
COPY --chown=www-data:www-data . /var/www/html
USER www-data
RUN yarn install && yarn production

# ------------------------

FROM runtime as production
COPY --chown=www-data --from=php-builder    /var/www/html        /var/www/html
COPY --chown=www-data --from=node-builder   /var/www/html/public /var/www/html/public

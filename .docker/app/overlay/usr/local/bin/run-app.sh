#!/usr/bin/env bash

set -e

role=${CONTAINER_ROLE:-app}
env=${APP_ENV:-production}
dbhost=${DB_HOST:-mysql}
automigrate=${AUTOMIGRATE:-false}

if [ "$env" != "local" ] && [ "$env" != "testing" ]; then
    echo "Caching configuration..."
    su -s /bin/bash -c 'cd /var/www/html && php artisan config:cache && (php artisan route:cache || true)' www-data
fi

confd -onetime -backend env

case "$role" in
    "queue")
        cp -ar /etc/services/worker /etc/service/worker01
        cp -ar /etc/services/worker /etc/service/worker02
        cp -ar /etc/services/worker /etc/service/worker03
        cp -ar /etc/services/worker /etc/service/worker04
        ;;
    "scheduler")
        cp -ar /etc/services/scheduler /etc/service/scheduler
        ;;
    "websockets")
        cp -ar /etc/services/websockets /etc/service/websockets
        ;;
    "app")
        cp -ar /etc/services/nginx /etc/service/nginx
        cp -ar /etc/services/php-fpm /etc/service/php-fpm
        ;;
esac

if [ "$automigrate" = "true" ]; then
    echo "Waiting for database connection..."
    until nc -z -v -w30 $dbhost 3306
    do
        # wait for 2 seconds before check again
        echo "."
        sleep 2
    done

    php artisan migrate --force
fi

exec "$@"

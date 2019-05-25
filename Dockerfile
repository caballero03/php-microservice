FROM php:7.2-cli-alpine

RUN apk update && apk add procps \
    && docker-php-ext-install bcmath pdo pdo_mysql sockets \
    && rm -rf /tmp/* /var/tmp/* \
    && rm -rf /var/cache/apk/*

# Set up CRON
COPY ./src/Cron/cron_main /etc/periodic/15min
RUN chmod +x /etc/periodic/15min/cron_main
    
# Use this for production instead of VOLUME /app
ADD . /app

VOLUME /app

WORKDIR /app

CMD ["sh", "/app/src/run_main.sh"]


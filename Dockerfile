# @description php image base on the php-swoole
#
#                       Some Information
# ------------------------------------------------------------------------------------
# @link https://hub.docker.com/_/phpswoole/      swoole image
# @link https://hub.docker.com/_/php/            php image
# ------------------------------------------------------------------------------------
# @build-example docker build . -f Dockerfile -t agarwood/oauth:2.0
#
FROM phpswoole/swoole:4.8.7-php8.1

LABEL maintainer="676786620@qq.com>" version="2.0"

# default TIMEZONE = Asia/Shanghai
ENV TIMEZONE="Asia/Shanghai"

# To install the Redis extension.
RUN set -ex \
    && apt-get update && apt-get install -y \
    && apt-get install git -y \
    && pecl update-channels \
    && pecl install redis-stable \
    && docker-php-ext-enable redis \
# To install the mongo extension.
    && pecl install mongodb-stable \
    && docker-php-ext-enable mongodb \
# Install PHP extensions
    && docker-php-ext-install \
      bcmath mysqli pdo_mysql \
# Clean apt cache
    && rm -rf /var/lib/apt/lists/*

# Timezone
RUN cp /usr/share/zoneinfo/${TIMEZONE} /etc/localtime \
    && echo "${TIMEZONE}" > /etc/timezone \
    && echo "[Date]\date.timezone=${TIMEZONE}" > /usr/local/etc/php/conf.d/timezone.ini
# Install composer deps

ADD . /var/www/agarwood

WORKDIR /var/www/agarwood

EXPOSE 18306 18307 18308

CMD ["php", "/var/www/agarwood/bin/agarwood", "http:start"]

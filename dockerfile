# FROM composer

FROM php:7.4-apache

MAINTAINER Significant Bits

# Which versions?
# ENV PHP_VERSION 7.3.33
# ENV REDIS_EXT_VERSION 5.2.1
# ENV IMAGICK_EXT_VERSION 3.4.4
# ENV HTTPD_VERSION 2.4.41
# ENV NGINX_VERSION 1.18.0
# ENV NODE_ENGINE 10.16.0
# ENV COMPOSER_VERSION 2
# ENV YARN_VERSION 1.22.4
# COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -yq \
    apt-transport-https \
    libaprutil1-dbd-mysql \
    libxml2-dev \
    libpng-dev \
    libxslt-dev \
    libtidy-dev \
    wget \
    libssl-dev \
    git \
    nano \
    libzip-dev \
    zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install zip

# zip optie verwijderd wegen libzip package probleem
RUN docker-php-ext-install \
    pdo_mysql \
    intl \
    gd \
    xsl \
    calendar \
    exif \
    gettext \
    mysqli \
    pcntl \
    shmop \
    sockets \
    sysvmsg \
    sysvsem \
    sysvshm \
    tidy
#
# # Install & configure xdebug
# RUN pecl install xdebug \
#     && docker-php-ext-enable xdebug \
#     && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini  \
#     && echo "xdebug.start_with_request=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini  \
#     && echo "xdebug.start_upon_error = default" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini  \
#     && echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini  \
#     && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#     #&& echo "zend_extension="<path to xdebug extension>"" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini  \
#    # && echo "xdebug.client_host=127.0.0.1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#     && echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#     #&& echo "xdebug.discover_client_host=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
#     && echo "xdebug.log=/var/www/Laravel-Party-website/service/php/etc/logs/xdebug.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

  #echo "xdebug.remote_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# COPY ./etc/wait-for-it.sh /wait-for-it.sh
# COPY ./etc/apache2.conf /etc/apache2/apache2.conf
# #COPY ./etc/envvars /etc/apache2/envvars
# #COPY ./etc/ports.conf /etc/apache2/ports.conf
# #COPY ./etc/magic /etc/apache2/magic
# #COPY ./etc/ssl /etc/apache2/ssl
# COPY ./etc/templates /etc/apache2/templates
# COPY ./etc/sites-available/* /etc/apache2/sites-available/
# COPY ./etc/logs /etc/apache2/logs
# Install xdebug (but don't enable) (Beta for php 7.3)
RUN apt-get update && apt-get -y install gcc make autoconf libc-dev pkg-config

# Install Composer
# RUN curl --silent --location https://lang-php.s3.amazonaws.com/dist-heroku-18-stable/composer-2.tar.gz | tar xz -C /app/.heroku/php
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# # Install Chrome WebDriver
# RUN CHROMEDRIVER_VERSION=`curl -sS chromedriver.storage.googleapis.com/LATEST_RELEASE` \
#  && mkdir -p /opt/chromedriver-$CHROMEDRIVER_VERSION \
#  && curl -sS -o /tmp/chromedriver_linux64.zip http://chromedriver.storage.googleapis.com/$CHROMEDRIVER_VERSION/chromedriver_linux64.zip \
#  && unzip -qq /tmp/chromedriver_linux64.zip -d /opt/chromedriver-$CHROMEDRIVER_VERSION \
#  && rm /tmp/chromedriver_linux64.zip \
#  && chmod +x /opt/chromedriver-$CHROMEDRIVER_VERSION/chromedriver \
#  && ln -fs /opt/chromedriver-$CHROMEDRIVER_VERSION/chromedriver /usr/local/bin/chromedriver
#
# # Install Google Chrome
# RUN wget -q -O - https://dl-ssl.google.com/linux/linux_signing_key.pub | apt-key add - \
#  && echo "deb http://dl.google.com/linux/chrome/deb/ stable main" >> /etc/apt/sources.list.d/google-chrome.list \
#  && apt-get update -qqy \
#  && apt-get -qqy install google-chrome-stable \
#  && rm /etc/apt/sources.list.d/google-chrome.list \
#  && rm -rf /var/lib/apt/lists/*

RUN pecl install xdebug
RUN echo "xdebug.mode=develop,debug,coverage" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    echo "xdebug.client_port=9000" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    echo "xdebug.log=/tmp/xdebug.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
#     echo "zend_extension=/app/.heroku/php/lib/php/extensions/no-debug-non-zts-20180731/xdebug.so" >> /app/.heroku/php/etc/php/php.ini

RUN a2enmod \
    socache_shmcb \
    rewrite \
    macro \
    filter \
    dbd \
    authn_dbd \
    authn_socache \
    ssl \
    php7

RUN a2enconf \
    charset \
    localized-error-pages \
    other-vhosts-access-log \
    security \
    serve-cgi-bin



WORKDIR /var/www/demo

RUN echo "date.timezone = \"Europe/Amsterdam\"" >> /usr/local/etc/php/php.ini &&\
    echo "short_open_tag = off" >> /usr/local/etc/php/php.ini &&\
    echo "session.use_strict_mode=On" >> /usr/local/etc/php/php.ini &&\
    echo "session.cookie_lifetime=0 " >> /usr/local/etc/php/php.ini &&\
    echo "session.use_only_cookies=On" >> /usr/local/etc/php/php.ini &&\
    echo "session.cookie_httponly=On" >> /usr/local/etc/php/php.ini &&\
    echo "session.cookie_secure=On" >> /usr/local/etc/php/php.ini &&\
#    echo "xdebug.client_port = 9003" >> /usr/local/etc/php/php.ini &&\
#    echo " session.cookie_samesite=\"Strict\"" >> /usr/local/etc/php/php.ini && \ // Only available per 7.3
    echo "session.sid_length=\"48\"" >> /usr/local/etc/php/php.ini && \
    echo "session.sid_bits_per_character=\"6\"" >> /usr/local/etc/php/php.ini

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf &&\
                                       a2dissite 000-default &&\
                                       service apache2 restart

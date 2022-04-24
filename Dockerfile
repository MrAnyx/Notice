FROM php:8.1.2-apache

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions pdo pdo_mysql intl gd opcache zip dom pcov mbstring dom

RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
   mv composer.phar /usr/local/bin/composer

RUN apt update && \
  apt install -yqq nano nodejs npm

RUN npm install -g yarn

# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# RUN apt-get update \
#     && apt-get install -y --no-install-recommends \
#     apt-utils libicu-dev g++ unzip libpng-dev libxml2-dev libzip-dev libonig-dev libxslt-dev ca-certificates apt-transport-https nano

# RUN docker-php-ext-configure intl
# RUN docker-php-ext-install pdo pdo_mysql gd opcache intl zip calendar dom mbstring xsl
# RUN pecl install apcu && docker-php-ext-enable apcu

RUN chmod -R 0777 /var/www/

COPY ./apache/vhosts.conf /etc/apache2/sites-available/000-default.conf

ENTRYPOINT [ "bash", "./docker.sh" ]

WORKDIR /var/www
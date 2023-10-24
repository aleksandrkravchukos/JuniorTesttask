FROM php:8.1-apache

ENV APACHE_CONF_DIR=/etc/apache2 \
    WORKING_DIR=/var/www/html

RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    unzip \
    vim mc curl  \
    && docker-php-ext-install pdo_mysql mbstring zip

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"

RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs npm

WORKDIR ${WORKING_DIR}

COPY . ${WORKING_DIR}
COPY ./docker/apache2.conf ${APACHE_CONF_DIR}/apache2.conf
COPY ./docker/default.conf ${APACHE_CONF_DIR}/sites-enabled/default.conf
COPY ./docker/php.ini  ${PHP_CONF_DIR}/apache2/conf.d/custom.ini

RUN chown -R www-data:www-data ${WORKING_DIR}/storage ${WORKING_DIR}/bootstrap/cache
RUN a2enmod rewrite
EXPOSE 80

CMD ["apache2-foreground"]

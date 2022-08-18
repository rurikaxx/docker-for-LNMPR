FROM laradock/php-fpm:latest-8.0

#COPY ./composer /usr/local/bin/composer

RUN apt-get update && apt-get install -y vim

RUN apt-get install -y libzip-dev && \
    docker-php-ext-configure zip && \
    docker-php-ext-install zip

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

#RUN apt-get install -y git zip
#
#RUN docker-php-ext-configure zip

#RUN apt-get install -yqq libmagickwand-dev imagemagick && \
#    cd /tmp && \
#    git clone https://github.com/Imagick/imagick; \
#    cd imagick && \
#    phpize && \
#    ./configure && \
#    make && \
#    make install && \
#    rm -r /tmp/imagick; \
#    docker-php-ext-enable imagick;

#RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini\
#&& sed -i "s/DB_PASSWORD=/DB_PASSWORD=root/g" /usr/local/etc/php/php.ini
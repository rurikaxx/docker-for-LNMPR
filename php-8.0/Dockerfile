FROM laradock/php-fpm:latest-8.0

#COPY ./composer /usr/local/bin/composer

RUN apt-get update && apt-get install -y vim

RUN apt-get install -y libzip-dev && \
    docker-php-ext-configure zip && \
    docker-php-ext-install zip

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
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
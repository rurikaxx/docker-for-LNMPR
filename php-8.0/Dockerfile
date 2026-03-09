FROM laradock/php-fpm:latest-8.0

#COPY ./composer /usr/local/bin/composer

RUN apt-get update && apt-get install -y vim

RUN apt-get install -y libzip-dev && \
    docker-php-ext-configure zip && \
    docker-php-ext-install zip

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'.PHP_EOL; } else { echo 'Installer corrupt'.PHP_EOL; unlink('composer-setup.php'); exit(1); }" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');"

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
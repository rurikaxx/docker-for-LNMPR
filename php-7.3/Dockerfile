FROM crunchgeek/php-fpm:7.3

COPY ./composer /usr/local/bin/composer

RUN apt-get update && apt-get install -y vim

#RUN apt-get install libzip-dev; & \
#    docker-php-ext-configure zip; & \
#    docker-php-ext-install zip;

#RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini\
#&& sed -i "s/DB_PASSWORD=/DB_PASSWORD=root/g" /usr/local/etc/php/php.ini
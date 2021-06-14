FROM crunchgeek/php-fpm:7.3

COPY ./composer /usr/local/bin/composer

RUN apt-get update && apt-get install -y vim

#RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini\
#&& sed -i "s/DB_PASSWORD=/DB_PASSWORD=root/g" /usr/local/etc/php/php.ini
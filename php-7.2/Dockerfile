FROM crunchgeek/php-fpm:7.2

#RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
#&& php -r "if (hash_file('sha384', 'composer-setup.php') === 'e0012edf3e80b6978849f5eff0d4b4e4c79ff1609dd1e613307e16318854d24ae64f26d17af3ef0bf7cfb710ca74755a') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
#&& php composer-setup.php \
#&& php -r "unlink('composer-setup.php');" \
#&& mv ./composer.phar /usr/local/bin/composer

COPY ./composer /usr/local/bin/composer

RUN apt-get update && apt-get install -y vim

RUN apt-get -y install libmcrypt-dev;

RUN pecl install mcrypt-1.0.1 \
    && docker-php-ext-enable mcrypt;


#COPY ./php.ini /usr/local/etc/php/php.ini

#vim +/pm.status_path www.conf

#RUN echo "pm.status_path = /php_fpm_status" >> /usr/local/etc/php-fpm.d/www.conf
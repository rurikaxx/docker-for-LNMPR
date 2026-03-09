FROM laradock/php-fpm:latest-8.3

COPY ./composer /usr/local/bin/composer

RUN apt-get update && apt-get install -y vim

RUN apt-get install -y libzip-dev && \
    docker-php-ext-configure zip && \
    docker-php-ext-install zip

RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

RUN apt-get install -yqq zlib1g-dev libicu-dev g++ \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl

#RUN apt-get install -y libxslt-dev g++ \
#    && docker-php-ext-configure xsl \
#    && docker-php-ext-install xsl
#
#RUN apt-get install -y wget \
#    && wget ftp://xmlsoft.org/libxml2/libxml2-2.9.2.tar.gz \
#    && tar -xvf libxml2-2.9.2.tar.gz \
#    && cd libxml2-2.9.2 \
#    && ./configure --prefix=/usr --disable-static --with-history && make \
#    make install

# apt-get install libxslt-dev
RUN apt-get update && apt-get install -y libxml2-dev \
    && docker-php-ext-configure soap \
    && docker-php-ext-install soap

RUN docker-php-ext-configure bcmath \
    && docker-php-ext-install bcmath

RUN apt-get install -y libxslt-dev \
    && docker-php-ext-configure xsl \
    && docker-php-ext-install xsl

RUN docker-php-ext-configure sockets \
    && docker-php-ext-install sockets

SHELL ["/bin/bash", "-c"]

#RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.1/install.sh | bash && source ~/.bashrc && nvm install 18.15.0

# RUN nvm install 18.15.0

#RUN apt-get update && apt install -y npm
#RUN npm install node@latest

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

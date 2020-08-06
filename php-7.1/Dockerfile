FROM php:7.1-fpm

RUN apt-get update -qq \
 && apt-get install -yqq \
    iputils-ping \
    procps \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng-dev \
    zlib1g-dev \
    libicu-dev \
    g++ \
    libxslt-dev \
    wkhtmltopdf \
 && apt-get clean -yqq


#
RUN docker-php-ext-install pdo_mysql \
 && docker-php-ext-install bcmath \
 && docker-php-ext-configure intl \
 && docker-php-ext-install intl \
 && docker-php-ext-configure gd \
    --enable-gd-native-ttf \
    --with-freetype-dir=/usr/include/freetype2 \
    --with-png-dir=/usr/include/ \
    --with-jpeg-dir=/usr/include/ \
 && docker-php-ext-install gd \
 && docker-php-ext-install mcrypt \
 && docker-php-ext-install zip \
 && docker-php-ext-install soap \
 && docker-php-ext-install xsl \
 && docker-php-ext-install opcache

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
&& php -r "if (hash_file('sha384', 'composer-setup.php') === 'e0012edf3e80b6978849f5eff0d4b4e4c79ff1609dd1e613307e16318854d24ae64f26d17af3ef0bf7cfb710ca74755a') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
&& php composer-setup.php \
&& php -r "unlink('composer-setup.php');" \
&& mv ./composer.phar /usr/local/bin/composer

RUN mkdir -p /usr/share/man/man1

COPY ./php.ini /usr/local/etc/php/conf.d

RUN apt-get update && apt-get install -y \
    libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
	&& docker-php-ext-enable imagick

#RUN yum install libevent2
#RUN yum install libevent-devel
#RUN pecl install event

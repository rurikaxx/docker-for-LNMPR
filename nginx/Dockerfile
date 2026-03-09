FROM nginx:1.19-alpine

LABEL maintainer="Mahmoud Zalt <mahmoud@zalt.me>"

COPY nginx.conf /etc/nginx/

RUN apk update \
    && apk upgrade \
    && apk add --no-cache openssl \
    && apk add --no-cache bash \
    && adduser -D -H -u 1000 -s /bin/bash www-data -G www-data

#ARG PHP_UPSTREAM_CONTAINER=php
#ARG PHP_UPSTREAM_PORT=9000
#
## Set upstream conf and remove the default conf
#RUN echo "upstream php-upstream { server ${PHP_UPSTREAM_CONTAINER}:${PHP_UPSTREAM_PORT}; }" > /etc/nginx/conf.d/upstream.conf \
#    && rm /etc/nginx/conf.d/default.conf

COPY ssl/private/local.key /etc/nginx/ssl/default.key
#COPY ssl/certs/server.pem /etc/nginx/ssl/default.key

ADD ./startup.sh /opt/startup.sh
RUN sed -i 's/\r//g' /opt/startup.sh
CMD ["/bin/bash", "/opt/startup.sh"]

EXPOSE 80 443

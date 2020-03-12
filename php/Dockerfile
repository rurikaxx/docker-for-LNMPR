FROM shareba/video_base:1.1

RUN echo "upload_max_filesize = 2048M" >> /etc/php.ini \
&&  echo "post_max_size = 2048M" >> /etc/php.ini
&&  echo "xdebug.remote_autostart = 0" >> /etc/php.ini \
&&  echo "xdebug.remote_enable = 0" >> /etc/php.ini \
&&  echo "xdebug.profiler_enable = 0" >> /etc/php.ini

RUN yum install -y fcgi

#RUN yum install libevent2
#RUN yum install libevent-devel
#RUN pecl install event

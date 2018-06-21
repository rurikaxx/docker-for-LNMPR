FROM shareba/video_base:1.1

RUN echo "upload_max_filesize = 2048M" >> /etc/php.ini \
&&  echo "post_max_size = 2048M" >> /etc/php.ini

RUN yum install -y fcgi

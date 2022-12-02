FROM cky97/ubuntu:22.04

ENV DEBIAN_FRONTEND=noninteractive

## nginx & php
RUN apt-get update && apt-get -y install \
    composer \
    curl \
    php8.1 php8.1-fpm php8.1-cli \
    php8.1-mysql mysql-client \
    php-bcmath php8.1-curl php8.1-gd php-mbstring php-zip php8.1-xml \
    php-redis \
    nginx \
    && apt-get clean

RUN rm /etc/nginx/sites-available/default
ADD default /etc/nginx/sites-available/default
# ADD default.ssl /etc/nginx/sites-available/default

## timezone KST
WORKDIR /etc/php/8.1/fpm
RUN sed -i "s/;date.timezone =/date.timezone = Asia\/Seoul/g" php.ini

## upload size
WORKDIR /etc/php/8.1/fpm
RUN sed -i "s/upload_max_filesize = 2M/upload_max_filesize = 11M/g" php.ini
RUN sed -i "s/post_max_size = 8M/post_max_size = 60M/g" php.ini
RUN sed -i "s/max_execution_time = 30/max_execution_time = 300/g" php.ini

## nginx: GET url length limit: upstream sent too big header while reading
WORKDIR /etc/nginx
RUN sed -i "/^http {/a fastcgi_buffers 16 16k;" nginx.conf
RUN sed -i "/^fastcgi_buffers 16 16k;/a fastcgi_buffer_size 32k;" nginx.conf

CMD ["/bin/bash", "-c", "/usr/sbin/service php8.1-fpm start && nginx -g 'daemon off;'"]

EXPOSE 80
EXPOSE 443

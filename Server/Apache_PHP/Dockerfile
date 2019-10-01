FROM php:5-apache
RUN apt-get update
RUN apt-get install -y openssl libssl-dev libcurl4-openssl-dev
RUN pecl install mongo
RUN echo "extension=mongo.so" > /usr/local/etc/php/conf.d/mongo.ini
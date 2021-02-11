FROM php:8.0.0rc1-fpm
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git
RUN apt-get install -y \
        libzip-dev \
        zip \
  && docker-php-ext-install zip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get install git
WORKDIR /var/www
ADD ./ /var/www/
RUN composer install
EXPOSE 9000
CMD ["php-fpm"]

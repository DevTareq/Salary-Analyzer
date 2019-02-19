FROM php:7.2-apache

# Install packages
RUN apt-get update && apt-get install -y vim git zip unzip libcurl4-openssl-dev pkg-config libssl-dev gnupg

# Install Node.js
RUN curl -sL https://deb.nodesource.com/setup_10.x | bash - && apt-get install -y nodejs
#RUN npm install gulp -g

# Enable Apache modules
RUN a2enmod rewrite

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN chmod o+w /var/www/html

# Install dependencies
#-RUN cd /var/www/html && composer install && composer dumpautoload
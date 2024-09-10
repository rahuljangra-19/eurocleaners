FROM php:8.2-apache

RUN apt-get update \
    && apt install -y \
      libzip-dev \
      unzip \
      git \
<<<<<<< HEAD
      nodejs \
      npm \
    && docker-php-ext-install  \
      mysqli  \
      pdo_mysql \
      zip \
      bcmath
=======
    && docker-php-ext-install  \
      mysqli  \
      pdo_mysql \
      zip
>>>>>>> dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmod rewrite
RUN a2enmod headers

FROM php:7.1-apache

RUN a2enmod rewrite

# Memory Limit
RUN echo "memory_limit=256M" > $PHP_INI_DIR/conf.d/memory-limit.ini

# Time Zone
RUN echo "date.timezone=Asia/Hong_Kong" > $PHP_INI_DIR/conf.d/date_timezone.ini

# Packages
RUN apt-get update && DEBIAN_FRONTEND=noninteractive apt-get install -y \
  libfreetype6-dev \
  libjpeg62-turbo-dev \
  libmcrypt-dev \
  libpng-dev \
  libbz2-dev \
  curl \
  git \
  unzip \
  mysql-client \
  && docker-php-ext-install -j$(nproc) zip bz2 bcmath pdo_mysql mysqli mbstring opcache \
  && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
  && docker-php-ext-install -j$(nproc) gd

# Environmental Variables
ENV COMPOSER_HOME /root/composer

# Add global binary directory to path
ENV PATH $COMPOSER_HOME/vendor/bin:$PATH

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    composer config -g github-oauth.github.com b920a503e5bb62ee4f4bcfeb1dfc76bad0706a2c

# Set up the application directory
WORKDIR /app
ENV APACHE_DOCUMENT_ROOT /app/web
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
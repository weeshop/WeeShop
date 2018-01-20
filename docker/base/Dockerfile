FROM webdevops/php-apache-dev:alpine-php7

RUN curl https://drupalconsole.com/installer -L -o drupal.phar && \
    mv drupal.phar /usr/local/bin/drupal && \
    chmod +x /usr/local/bin/drupal && \
    drupal self-update

# Install Drupal Commerce 2.x via drupalcommerce/project-base
RUN composer create-project drupalcommerce/project-base \
 --stability dev \
 --no-interaction \
 .

RUN composer require "drupal/core:^8.4" \
                    "drupal/facets:1.x-dev" \
                    "drupal/devel:1.x-dev" \
                    "drupal/default_content" \
                    "drupal/file_entity:2.x-dev" \
                    "drupal/restui" \
                    "drupal/simple_oauth" \
                    "drupal/openapi" \
                    "drupal/erd" \
                    "drupal/commerce_shipping"
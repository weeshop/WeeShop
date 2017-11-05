FROM edwinkent/catshop:base-latest

USER www-data

# Install Drupal Commerce 2.x via drupalcommerce/project-base
RUN composer create-project drupalcommerce/project-base \
 --stability dev \
 --no-interaction \
 . && \
 composer require "drupal/devel:1.x-dev" "drupal/default_content"


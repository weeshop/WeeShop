FROM drupalcommerce/commerce:v2-7-apache

RUN composer self-update && composer require "drupal/devel:1.x-dev" "drupal/default_content"


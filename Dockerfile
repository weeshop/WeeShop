FROM edwinkent/catshop:base-latest

# Install Drupal Commerce 2.x via drupalcommerce/project-base
RUN composer create-project drupalcommerce/project-base \
 --stability dev \
 --no-interaction \
 . && \
 composer require "drupal/devel:1.x-dev" "drupal/default_content" "drush/drush"


RUN curl -o drush.phar https://github.com/drush-ops/drush-launcher/releases/download/0.4.2/drush.phar && \
    chmod +x drush.phar && \
    mv drush.phar /usr/local/bin/drush && \
    drush self-update

RUN usermod -s /bin/bash www-data
USER www-data

ADD . profiles/custom/catshop

RUN drush -y site-install catshop \
    install_configure_form.site_default_country=CN \
    install_configure_form.site_timezone='Asia/Hong_Kong' \
    install_configure_form.enable_update_status_module=NULL \
    install_configure_form.enable_update_status_emails=NULL \
     --db-url="sqlite://sites/default/files/.ht.sqlite" \
     --account-name=admin --account-pass=123 --account-mail=164713332@qq.com \
     --site-name=测试网站 --locale=zh-hans

USER root
RUN composer config repo.packagist composer "https://packagist.phpcomposer.com"


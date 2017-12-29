FROM registry.cn-hangzhou.aliyuncs.com/catshop/catshop:base

# Install Drupal Commerce 2.x via drupalcommerce/project-base
RUN composer create-project drupalcommerce/project-base \
 --stability dev \
 --no-interaction \
 .

RUN curl -L -o drush.phar https://github.com/drush-ops/drush-launcher/releases/download/0.4.2/drush.phar && \
    chmod +x drush.phar && \
    mv drush.phar /usr/local/bin/drush && \
    drush self-update

RUN curl https://drupalconsole.com/installer -L -o drupal.phar && \
    mv drupal.phar /usr/local/bin/drupal && \
    chmod +x /usr/local/bin/drupal && \
    drupal self-update

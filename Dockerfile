FROM edwinkent/catshop:base-latest

RUN chown -R www-data ./web/sites && \
    chown www-data . && \
    usermod -s /bin/bash www-data

RUN composer config repo.packagist composer "https://packagist.phpcomposer.com"

RUN mkdir web/sites/default/files/translations && \
    curl -o web/sites/default/files/translations/drupal-8.4.2.zh-hans.po https://ftp.drupal.org/files/translations/8.x/drupal/drupal-8.4.2.zh-hans.po
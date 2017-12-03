FROM edwinkent/catshop:base-latest

RUN chown -R www-data ./web/sites && \
    chown www-data . && \
    chown www-data /var/www && \
    usermod -s /bin/bash www-data

RUN composer config repo.packagist composer "https://packagist.phpcomposer.com"

RUN mkdir web/sites/default/files/translations && \
    curl -o web/sites/default/files/translations/drupal-8.4.2.zh-hans.po https://ftp.drupal.org/files/translations/8.x/drupal/drupal-8.4.2.zh-hans.po

WORKDIR /app/web
ADD . profiles/custom/catshop

RUN service mysql start && sleep 10 && \
    drush -y -vvv --root=/app/web site-install catshop \
    install_configure_form.site_default_country=CN \
    install_configure_form.enable_update_status_emails=NULL \
    --db-url=mysql://root@localhost:3306/drupal \
    --account-name=admin --account-pass=123 \
    --account-mail=164713332@qq.com --site-name=测试网站 \
    --locale=zh-hans
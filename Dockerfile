FROM edwinkent/catshop:base-latest

RUN chmod -R o+w ./web/sites && \
    usermod -s /bin/bash www-data
USER www-data
WORKDIR /app/web

ADD . profiles/custom/catshop

USER root


RUN drush -y site-install catshop \
    install_configure_form.site_default_country=CN \
    install_configure_form.site_timezone='Asia/Hong_Kong' \
    install_configure_form.enable_update_status_module=NULL \
    install_configure_form.enable_update_status_emails=NULL \
     --db-url="sqlite://sites/default/files/.ht.sqlite" \
     --account-name=admin --account-pass=123 --account-mail=164713332@qq.com \
     --site-name=测试网站 --locale=zh-hans

ENV APACHE_DOCUMENT_ROOT /app/web

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
FROM edwinkent/catshop:base-latest

RUN chown -R www-data ./web/sites && \
    chown www-data . && \
    usermod -s /bin/bash www-data
USER www-data
WORKDIR /app/web

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
WORKDIR /app
RUN composer config repo.packagist composer "https://packagist.phpcomposer.com"
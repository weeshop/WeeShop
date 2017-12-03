FROM registry.cn-hangzhou.aliyuncs.com/catshop/catshop:base-latest

RUN chown -R www-data ./web/sites && \
    chown www-data . && \
    chown www-data /var/www && \
    usermod -s /bin/bash www-data

RUN composer config repo.packagist composer "https://packagist.phpcomposer.com"

RUN mkdir web/sites/default/files/translations && \
    curl -o web/sites/default/files/translations/drupal-8.4.2.zh-hans.po https://ftp.drupal.org/files/translations/8.x/drupal/drupal-8.4.2.zh-hans.po

WORKDIR /app/web
ADD . profiles/custom/catshop

RUN sed -i '/bind-address/d' /etc/mysql/mariadb.conf.d/50-server.cnf && \
    sed -e 's/256/512/' /usr/local/etc/php/conf.d/memory-limit.ini && \
    service mysql start && sleep 10 && \
    mysqladmin -u root password 123 && \
    mysql -u root -p123 -e "update user set plugin='' where User='root';" && \
    mysql -u root -p123 -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY '123' WITH GRANT OPTION;" && \
    mysql -u root -p123 -e "FLUSH PRIVILEGES;"


USER www-data
RUN drush -y -vvv --root=/app/web site-install catshop \
        install_configure_form.site_default_country=CN \
        install_configure_form.enable_update_status_emails=NULL \
        --db-url=mysql://root:123@127.0.0.1:3306/drupal \
        --account-name=admin --account-pass=123 \
        --account-mail=164713332@qq.com --site-name=测试网站 \
        --locale=zh-hans
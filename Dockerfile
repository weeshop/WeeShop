FROM registry.cn-hangzhou.aliyuncs.com/catshop/catshop:catshop_base

RUN chown -R www-data ./web/sites && \
    chown www-data . && \
    chown www-data /var/www && \
    usermod -s /bin/bash www-data

RUN composer config repo.packagist composer "https://packagist.phpcomposer.com"

RUN mkdir -p web/sites/default/files/translations && \
    curl -Lo web/sites/default/files/translations/drupal-8.4.3.zh-hans.po http://ftp.drupal.org/files/translations/8.x/drupal/drupal-8.4.3.zh-hans.po && \
    mkdir -p web/libraries && \
    cd web/libraries && \
    curl -LO https://github.com/swagger-api/swagger-ui/archive/v3.0.17.zip && \
    unzip v3.0.17.zip && \
    ln -s swagger-ui-3.0.17 swagger-ui

WORKDIR /app/web
ADD . profiles/custom/catshop

RUN sed -e 's/256/512/' /usr/local/etc/php/conf.d/memory-limit.ini && \
    cp -aRT /app/web/sites /app/web/sites_bak

VOLUME ["/app/web/sites"]
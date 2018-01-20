FROM registry.cn-hangzhou.aliyuncs.com/catshop/catshop:base

RUN cd /app && composer config repo.packagist composer "https://packagist.phpcomposer.com"

RUN mkdir -p /app/web/sites/default/files/translations && \
    curl -Lo /app/web/sites/default/files/translations/drupal-8.4.4.zh-hans.po http://ftp.drupal.org/files/translations/8.x/drupal/drupal-8.4.4.zh-hans.po && \
    mkdir -p /app/web/libraries && \
    cd /app/web/libraries && \
    curl -LO https://github.com/swagger-api/swagger-ui/archive/v3.0.17.zip && \
    unzip v3.0.17.zip && rm -f v3.0.17.zip && \
    ln -s swagger-ui-3.0.17 swagger-ui

RUN cp -aRT /app/web/sites /app/web/sites_bak

VOLUME ["/app/web/sites"]
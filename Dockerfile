FROM edwinkent/catshop:base-latest

RUN chown -R www-data ./web/sites && \
    chown www-data . && \
    usermod -s /bin/bash www-data

RUN composer config repo.packagist composer "https://packagist.phpcomposer.com"
FROM edwinkent/catshop:base-latest

RUN chmod -R o+w ./web/sites && \
    usermod -s /bin/bash www-data
USER www-data
WORKDIR /app/web

ADD . profiles/custom/catshop




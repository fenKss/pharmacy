FROM php:8.0-fpm-alpine
RUN apk add libc-dev autoconf nano g++ make unixodbc-dev
RUN pecl install sqlsrv
RUN apk add musl-dev
RUN pecl install pdo_sqlsrv
RUN pecl install xdebug
RUN apk add  unixodbc unixodbc-dev  \
         && docker-php-ext-configure pdo_odbc --with-pdo-odbc=unixODBC,/usr \
         && docker-php-ext-install pdo_odbc
RUN docker-php-ext-enable sqlsrv pdo_sqlsrv xdebug
RUN curl -O https://download.microsoft.com/download/b/9/f/b9f3cce4-3925-46d4-9f46-da08869c6486/msodbcsql18_18.0.1.1-1_amd64.apk
RUN apk add --allow-untrusted msodbcsql18_18.0.1.1-1_amd64.apk
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN apk add yaml-dev
RUN pecl install  yaml && docker-php-ext-enable yaml
WORKDIR /var/www/project
ENTRYPOINT php -S 0.0.0.0:8080 -t public
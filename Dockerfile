FROM ubuntu:16.04
RUN locale-gen en_US.UTF-8 \
    && export LANG=en_US.UTF-8 \
    && apt-get update \
    && apt-get install -y software-properties-common \
    && apt-get install -y language-pack-en-base \
    && LC_ALL=en_US.UTF-8 \
    && apt-get update \
    && apt-get -y install apache2 php7-mysql  libapache2-mod-php7.0 php7.0 php7.0-cli php-xdebug php7.0-mbstring sqlite3 php-apcu php-apcu-bc php-imagick php-memcached php-pear curl imagemagick php7.0-dev php7.0-phpdbg php7.0-gd npm nodejs-legacy php7.0-json php7.0-curl php7.0-sqlite3 php7.0-intl apache2 vim git-core zip wget libsasl2-dev libssl-dev libsslcommon2-dev libcurl4-openssl-dev autoconf g++ make openssl libssl-dev libcurl4-openssl-dev pkg-config libsasl2-dev libpcre3-dev \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
    && a2enmod headers \
    && a2enmod rewrite \
    && npm install -g grunt-cli bower \
    && pecl channel-update pecl.php.net \
    && pecl install mongodb \
    && echo "extension=mongodb.so" >> /etc/php/7.0/apache2/php.ini \
    && echo "extension=mongodb.so" >> /etc/php/7.0/cli/php.ini
RUN apt-get install -y php7.0-bcmath
RUN a2enmod rewrite
RUN usermod -u 1000 www-data
COPY php.ini /usr/local/etc/php/
COPY vhost.conf /etc/apache2/sites-enabled/
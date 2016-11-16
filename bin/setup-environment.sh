#!/usr/bin/env bash

export DEBIAN_FRONTEND=noninteractive
apt -q -y  install python-software-properties screen htop curl wget sed
apt install -y software-properties-common
apt install -y language-pack-en-base LC_ALL=en_US.UTF-8
locale-gen en_US en_US.UTF-8

sudo apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv EA312927
echo "deb http://repo.mongodb.org/apt/ubuntu xenial/mongodb-org/3.2 multiverse" | sudo tee /etc/apt/sources.list.d/mongodb-org-3.2.list

wget http://www.rabbitmq.com/rabbitmq-signing-key-public.asc
apt-key add rabbitmq-signing-key-public.asc

add-apt-repository ppa:ondrej/php

apt update

apt -y install git-core zip wget mc cmake libsasl2-dev libssl-dev libsslcommon2-dev libcurl4-openssl-dev autoconf g++ make openssl libssl-dev libcurl4-openssl-dev pkg-config libsasl2-dev libpcre3-dev
apt install -q -y rabbitmq-server mongodb-org memcached libcurl3-openssl-dev

service rabbitmq-server stop
rabbitmq-plugins enable rabbitmq_management
service rabbitmq-server start
rabbitmq-plugins list

apt -y install apache2
a2enmod headers
a2enmod rewrite

chmod 0777 -R /var/www/html/wellcart

sed -i "s#DocumentRoot /var/www/html#DocumentRoot /var/www/html/wellcart/public#g" /etc/apache2/sites-available/000-default.conf
sed -i "s#AllowOverride None#AllowOverride All#g" /etc/apache2/apache2.conf
echo "SetEnv WELLCART_CONTAINER_ENV true" >> /etc/apache2/sites-available/000-default.conf

apt -q -y install mysql-server mysql-client
mysql -u root -e "CREATE DATABASE wellcart;"
mysql -u root -e "CREATE USER 'wellcart'@'localhost' IDENTIFIED BY 't00r';"
mysql -u root -e "GRANT ALL PRIVILEGES ON * . * TO 'wellcart'@'localhost';"

service mysql restart

apt -y install php7.0-cli php7.0-common libapache2-mod-php7.0 php-memcached php-memcache php-mongo php-amqp php7.0 php7.0-mysql php-http php-xdebug php7.0-mbstring php7.0-bcmath php-imagick php-xml php-mcrypt php-zip php-pear imagemagick php7.0-dev php7.0-gd npm nodejs-legacy php7.0-json php7.0-curl php7.0-sqlite3 php7.0-intl php7.0-pgsql
pecl channel-update pecl.php.net

npm install -g grunt-cli bower less sass

curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

echo "session.auto_start = 0" >> /etc/php/7.0/cli/php.ini
echo "session.save_path = /tmp" >> /etc/php/7.0/cli/php.ini
echo "date.timezone = UTC" >> /etc/php/7.0/cli/php.ini

echo "session.auto_start = 0" >> /etc/php/7.0/apache2/php.ini
echo "session.save_path = /tmp" >> /etc/php/7.0/apache2/php.ini
echo "date.timezone = UTC" >> /etc/php/7.0/apache2/php.ini

# pear config-set php_ini /etc/php/7.0/apache2/php.ini

echo "xdebug.remote_enable = 1" >> /etc/php/7.0/apache2/php.ini
echo "xdebug.remote_connect_back = 1" >> /etc/php/7.0/apache2/php.ini

chown -R www-data /var/www/html/wellcart/
find /var/www/html/wellcart/ -type d -exec chmod 700 {} \;
find /var/www/html/wellcart/ -type f -exec chmod 600 {} \;

cd /var/www/html/wellcart/

composer install
chmod 0777 bin/wellcart
bin/wellcart wellcart:setup --db-host=localhost --db-name=wellcart --db-username=wellcart --db-password=t00r --admin-email=dev@example.com --admin-password=qa123123 --admin-first-name=Developer --admin-last-name=Account --base-path=http://localhost:8080/ --website-name=Development

service apache2 restart

echo "Instance ready to use..."
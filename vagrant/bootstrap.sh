#!/usr/bin/env bash
#
# This script provisions the box with essentials for this project.
#
# Installs Apache2, PHP 5.6, Memcache, PHPUnit, and Xdebug.
# Places source files in correct location by linking /vagrant/src to /var/www/html.
# Set Xdebug config by copying xdebug.ini to /etc/php5/mods-available/xdebug.ini.

# Add PHP 5.6 repo, update, and install required packages.
add-apt-repository -y ppa:ondrej/php5-5.6
apt-get update -y
apt-get install python-software-properties
apt-get install -y apache2
apt-get install -y libapache2-mod-php5
apt-get install -y php5-memcache memcached
apt-get install -y php5-xdebug

# Enable the PHP5 Apache module.
a2enmod php5

# Copy PHPUnit to /usr/local/bin and change access permissions.
cp /vagrant/phpunit-5.3.4.phar /usr/local/bin/phpunit
chmod +x /usr/local/bin/phpunit

# Set the Xdebug config.
cp /vagrant/vagrant/xdebug.ini /etc/php5/mods-available/xdebug.ini

# Link the source files to the Apache web root.
if ! [ -L /var/www/html ]; then
  rm -rf /var/www/html
  ln -fs /vagrant/src /var/www/html
fi

# Restart Apache so that these changes can take effect.
service apache2 restart
#!/usr/bin/env bash
# Codeception system tests setup

set -e

BASE="$1"

cd $BASE

sudo apt-get update -qq
sudo apt-get install -y --force-yes apache2 libapache2-mod-fastcgi php5-curl php5-mysql php5-intl php5-gd fluxbox > /dev/null

sudo mkdir $BASE/.run

sudo cp ~/.phpenv/versions/$(phpenv version-name)/etc/php-fpm.conf.default ~/.phpenv/versions/$(phpenv version-name)/etc/php-fpm.conf
sudo sed -e "s,listen = 127.0.0.1:9000,listen = /tmp/php5-fpm.sock,g" --in-place ~/.phpenv/versions/$(phpenv version-name)/etc/php-fpm.conf
sudo sed -e "s,;listen.owner = nobody,listen.owner = $USER,g" --in-place ~/.phpenv/versions/$(phpenv version-name)/etc/php-fpm.conf
sudo sed -e "s,;listen.group = nobody,listen.group = $USER,g" --in-place ~/.phpenv/versions/$(phpenv version-name)/etc/php-fpm.conf
sudo sed -e "s,;listen.mode = 0660,listen.mode = 0666,g" --in-place ~/.phpenv/versions/$(phpenv version-name)/etc/php-fpm.conf
sudo sed -e "s,user = nobody,;user = $USER,g" --in-place ~/.phpenv/versions/$(phpenv version-name)/etc/php-fpm.conf
sudo sed -e "s,group = nobody,;group = $USER,g" --in-place ~/.phpenv/versions/$(phpenv version-name)/etc/php-fpm.conf

sudo a2enmod rewrite actions fastcgi alias
echo "cgi.fix_pathinfo = 1" >> ~/.phpenv/versions/$(phpenv version-name)/etc/php.ini
sudo cp -f tests/travis-ci-apache.conf /etc/apache2/sites-available/default
sudo sed -e "s?%TRAVIS_BUILD_DIR%?$BASE?g" --in-place /etc/apache2/sites-available/default
git submodule update --init --recursive

sudo service apache2 restart

# Xvfb
sudo /etc/init.d/xvfb start
sleep 1 # give xvfb some time to start

# Fluxbox
fluxbox &
sleep 3 # give fluxbox some time to start

# Composer in tests folder
cd tests/
composer install
cd $BASE

sudo cp RoboFile.dist.ini RoboFile.ini
sudo cp tests/acceptance.suite.dist.yml tests/acceptance.suite.yml

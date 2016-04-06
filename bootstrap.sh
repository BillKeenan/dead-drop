#!/usr/bin/env bash

sudo apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv 7F0CEB10
sudo echo 'deb http://downloads-distro.mongodb.org/repo/ubuntu-upstart dist 10gen' | sudo tee /etc/apt/sources.list.d/mongodb.list
sudo apt-get update

sudo apt-get install -y python-software-properties

sudo add-apt-repository -y ppa:ondrej/php5-5.6
sudo add-apt-repository -y ppa:ondrej/apache2
sudo apt-get update

sudo apt-get install make
sudo apt-get update

sudo apt-get install -y apache2
sudo mv /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/
sudo apt-get install -y php5

sudo apt-get install -y php5-dev
sudo apt-get install -y php5-cli 
sudo apt-get install -y php5-pear 
sudo apt-get install -y mongodb-org
printf "\n" | sudo pecl install mongo

sudo rm /etc/apache2/sites-enabled/*
sudo cp /vagrant/apache.conf /etc/apache2/sites-enabled/

sudo bash -c "echo 'extension=mongo.so' >> /etc/php5/apache2/php.ini"
sudo bash -c "echo 'extension=mongo.so' >> /etc/php5/cli/php.ini"
mongo testLoad --eval "db.createUser({user:'dev',pwd:'dev',roles:['readWrite']})"

sudo rm -rf /var/lock/apache2
sudo sed -i 's/www-data/vagrant/g' /etc/apache2/envvars


sudo apachectl restart



echo "run this -> open http://localhost:9001"
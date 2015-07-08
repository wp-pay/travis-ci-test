#!/bin/bash

# Delete WordPress
rm -rf ./wordpress/

# Download WP-CLI
wget -O wp-cli.phar https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli-nightly.phar

# Make sure WP-CLI is executable
chmod +x wp-cli.phar

# Check if WP-CLI works
php wp-cli.phar --info

# Download WordPress into `wordpress` directory
php wp-cli.phar core download

# Create wp-config.php
php wp-cli.phar core config

# Create database
php wp-cli.phar db create

# Install WordPress
php wp-cli.phar core install

# Server
php wp-cli.phar server &
PHP_SERVER_PID=$!

# Download Selenium
wget -O selenium-server-standalone.jar http://selenium-release.storage.googleapis.com/2.46/selenium-server-standalone-2.46.0.jar

# Start Selenium
xvfb-run java -jar selenium-server-standalone.jar &
SELENIUM_SERVER_PID=$!

wget --retry-connrefused --tries=60 --waitretry=1 http://127.0.0.1:4444/wd/hub/status -O /dev/null
if [ ! $? -eq 0 ]; then
    echo "Selenium Server not started"
else
    echo "Finished setup"
fi

echo "PHP Server Process ID: $PHP_SERVER_PID"

echo "Selenium Server Process ID: $SELENIUM_SERVER_PID"

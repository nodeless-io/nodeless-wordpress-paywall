#!/bin/sh
composer install --no-dev
rm nodelessio-paywall.zip
zip -r nodelessio-paywall.zip . --exclude='.git/*'
echo "Done"



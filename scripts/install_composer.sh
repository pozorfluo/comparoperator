#!/bin/sh

# note
#   Path resolution will misbehave if this is script is sourced.
#   Do not source it.
DIR=$(pwd)
SCRIPT_DIR="$(dirname "$(realpath $0)")"
SCRIPT_NAME="$(basename $0)"
echo "\t${SCRIPT_NAME%.*} in ${DIR}"

EXPECTED_CHECKSUM="$(wget -q -O - https://composer.github.io/installer.sig)"
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
ACTUAL_CHECKSUM="$(php -r "echo hash_file('sha384', 'composer-setup.php');")"

if [ "$EXPECTED_CHECKSUM" != "$ACTUAL_CHECKSUM" ]
then
    >&2 echo 'ERROR: Invalid installer checksum'
    rm composer-setup.php
    exit 1
fi

php composer-setup.php --quiet
RESULT=$?
rm composer-setup.php
echo
php composer.phar --version
exit $RESULT
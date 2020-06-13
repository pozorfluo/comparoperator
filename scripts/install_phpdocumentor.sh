#!/bin/sh

# todo
#   - [ ] verify downloaded .phar key
#
# note
#   Path resolution will misbehave if this is script is sourced.
#   Do not source it.
DIR=$(pwd)
SCRIPT_DIR="$(dirname "$(realpath $0)")"
SCRIPT_NAME="$(basename $0)"
echo "\t${SCRIPT_NAME%.*} in ${DIR}"

php -r "copy(
            'https://github.com/phpDocumentor/phpDocumentor/releases/download/v3.0.0-rc/phpDocumentor.phar',
            'phpDocumentor.phar'
        );"
RESULT=$?
echo
php phpDocumentor.phar --version
exit $RESULT
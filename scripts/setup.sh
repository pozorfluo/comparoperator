#!/bin/sh

# note
#   Path resolution will misbehave if this is script is sourced.
#   Do not source it.
DIR=$(pwd)
SCRIPT_DIR="$(dirname "$(realpath $0)")"
SCRIPT_NAME="$(basename $0)"
echo "\n${SCRIPT_NAME%.*} :"

# install composer in project root dir
COMPOSER="composer.phar"

if [ -f "$COMPOSER" ]; then
    echo "\n\t$COMPOSER already installed.\n"
    php ${COMPOSER} --version
else
    ${SCRIPT_DIR}/install_composer.sh
fi

# install project php depedencies
php composer.phar install
echo

# install phpDocumentor
DOCUMENTOR="phpDocumentor.phar"
if [ -f "$DOCUMENTOR" ]; then
    echo "\n\t$DOCUMENTOR already installed.\n"
    php ${DOCUMENTOR} --version
else
    ${SCRIPT_DIR}/install_phpdocumentor.sh
fi

echo "\n\tnote : phpDocumentor requires Graphviz to generate class diagrams.\n"
echo "\tinstall Graphviz :"
echo "\t$ sudo apt install graphviz"
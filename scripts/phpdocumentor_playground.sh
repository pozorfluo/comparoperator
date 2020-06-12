# retrieve the php archive
# curl -IL http://www.phpdoc.org/phpDocumentor.phar
# curl -L -o phpDocumentor.phar http://www.phpdoc.org/phpDocumentor.phar
curl -L -o phpDocumentor.phar https://github.com/phpDocumentor/phpDocumentor/releases/download/v3.0.0-rc/phpDocumentor.phar

# install phpDocumentor
chmod +x phpDocumentor.phar
sudo mv phpDocumentor.phar /usr/local/bin/phpDocumentor 

# install graphviz
sudo apt-get install graphviz

# run in source dir, output to target dir
# php phpDocumentor.phar -d ./src -t docs/ --template="zend"
phpDocumentor -d ./src -t docs/ -s graphs.enabled=true


# see https://github.com/phpDocumentor/phpDocumentor
# https://docs.phpdoc.org/latest/getting-started/changing-the-look-and-feel.html
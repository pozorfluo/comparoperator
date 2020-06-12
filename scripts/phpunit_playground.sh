# generate autoload files
php composer.phar dump-autoload

# list 
./vendor/bin/phpunit --list-tests

# run tests
# ./vendor/bin/phpunit tests --bootstrap src/Helpers/AutoLoader.php
./vendor/bin/phpunit tests
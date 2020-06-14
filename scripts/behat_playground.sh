# initialize feature test suite
scripts/behat --init

# remove from dev dependencies
php composer.phar remove behat/behat --dev
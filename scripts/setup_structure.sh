#!/bin/bash

# setup basic project structure
mkdir public
mkdir resources
mkdir scripts
mkdir src
mkdir tests
ln -s public htdocs

# create new empty template
# TEMPLATE_NAME = map_frame
# cat <<EMPTY_TEMPLATE > src/Templates/${TEMPLATE_NAME}.php
cat <<EMPTY_TEMPLATE > src/Templates/map_frame.php
<?php

/**
 * 
 */

declare(strict_types=1);
return <<<TEMPLATE

TEMPLATE;
EMPTY_TEMPLATE

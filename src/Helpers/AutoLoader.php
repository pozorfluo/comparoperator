<?php

/**
 * 
 */

declare(strict_types=1);

namespace Helpers;

/**
 * 
 */
spl_autoload_register(function (string $class): bool {

    $base_dir = ROOT.'src/';
    
    /* Not currently using a project prefix */

    // $project_prefix = '';
    // $prefix_length = strlen($project_prefix);
    // if (strncmp($project_prefix, $class, $prefix_length) !== 0) {
    //     return;
    // }

    // get the relative class name
    // $class = substr($class, $prefix_length);


    $file = $base_dir . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    if (is_file($file)) {
        require $file;
        return true;
    }
    return false;
});

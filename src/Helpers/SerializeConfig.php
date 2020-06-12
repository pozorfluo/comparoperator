<?php

declare(strict_types=1);

// namespace Helpers;

/**
 * Serialize config to file if needed once the page is served 
 */
$t = microtime(true);

if (!$config_exists) {
    $config_file = fopen($config_path, 'w');
    fwrite($config_file, json_encode($config));
    fclose($config_file);
}

$time_spent['serialize_config'] = (microtime(true) - $t);

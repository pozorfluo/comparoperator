<?php

declare(strict_types=1);

// namespace Helpers;

/**
 * Get list of registered components, database configs, etc... from config file
 * or provide/build some defaults.
 */
$t = microtime(true);

$config_path = ROOT . '.env';
$config_exists = is_file($config_path);


if ($config_exists) {
    $config = json_decode(file_get_contents($config_path), true);
}

if (!isset($config['components']) || DEV_FORCE_CONFIG_UPDATE) {
    $src_dir = new RecursiveDirectoryIterator(ROOT . 'src' . DIRECTORY_SEPARATOR);
    $iterator = new RecursiveIteratorIterator($src_dir);
    $php_files = new RegexIterator(
        $iterator,
        '/^.+\.php$/i',
        RecursiveRegexIterator::GET_MATCH
    );

    /* reset for DEV_FORCE_CONFIG_UPDATE */
    $config['components'] = [];

    foreach ($php_files as $php_file) {
        /* do NOT register abstract classes or interfaces */
        $is_interface_or_abstract = preg_match(
            '/abstract class\s.+\n\{|interface\s.+\n\{/',
            file_get_contents($php_file[0])
        );

        if (!$is_interface_or_abstract) {
            $component = array_slice(explode(DIRECTORY_SEPARATOR, $php_file[0]), -2);
            $config['components'][$component[0]][] = substr($component[1], 0, -4);
        }
    }
    $config_exists = false;
    // echo 'components config missing ! Defaults emitted. <br />';
}
if (!isset($config['db_configs'])) {
    $config['db_configs'] = [
        'default' => [
            'DB_DRIVER' => 'mysql',
            'DB_HOST' => '127.0.0.1',
            'DB_PORT' => '3306',
            'DB_NAME' => 'default',
            'DB_CHARSET' => 'utf8mb4',
            'DB_USER' => null,
            'DB_PASSWORD' => null,
        ]
    ];
    $config_exists = false;
    // echo 'db_configs config missing ! Defaults emitted.<br />';
}

$time_spent['config'] = (microtime(true) - $t);
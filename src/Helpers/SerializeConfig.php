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

    /**
     * @note Explore config as a class.
     */
    $db_config_string = var_export($config['db_configs'], true);
    $components_config_string = var_export($config['components'], true);
    $config_class = <<<CONFIG
        <?php
        declare(strict_types=1);
        namespace Helpers;
        /**
         * 
         */
        class Config
        {
            /**
             * @var array 
             */
            const db = {$db_config_string};
            
            /**
             * @var array 
             */
            const components = {$components_config_string};
        }
        CONFIG;

    $config_file = fopen(ROOT . 'src/Helpers/Config.php', 'w');
    fwrite($config_file, $config_class);
    fclose($config_file);
}

$time_spent['serialize_config'] = (microtime(true) - $t);

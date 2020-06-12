<?php

declare(strict_types=1);

// namespace Helpers;

$t = microtime(true);

if (!in_array('Content-Type: application/json', headers_list())) {
    require_once ROOT . 'src/Helpers/Utilities.php';
    require ROOT . 'src/Helpers/GlobalsDump.php';

    $time_spent['display_debug'] = (microtime(true) - $t);
    $time_spent['total'] = array_sum($time_spent);

    echo "<pre>config           : {$time_spent['config']}</pre>";
    echo "<pre>serving_page     : {$time_spent['serving_page']}</pre>";
    echo "<pre>serialize_config : {$time_spent['serialize_config']}</pre>";
    echo "<pre>display_debug    : {$time_spent['display_debug']}</pre>";
    echo "<pre>total            : {$time_spent['total']}</pre>";
}
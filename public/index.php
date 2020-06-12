<?php

/**
 * Setup
 * Retrieve configuration
 * Run the app !
 * 
 * @note
 *   This is is the main entry point
 * 
 * @todo
 */

declare(strict_types=1);

define('ROOT', str_replace('public', '', __DIR__));
define('DEV_GLOBALS_DUMP', true);
require ROOT . 'src/Helpers/AutoLoader.php';

//--------------------------------------------------------------- playground

//------------------------------------------------------------------ session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    /* generate a CRSF guard token */
    if (empty($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }
}
//------------------------------------------------------------------- config
date_default_timezone_set('Europe/Paris');
//--------------------------------------------------------------- playground

//---------------------------------------------------------------------- run
$t = microtime(true);

define('TEMPLATE', ROOT . 'src/Templates/');

$hero = [
    'content' => include TEMPLATE . 'cta_newsletter.php'
];

$layout = [
    'title' => 'Yacht Share Prestige',
    'nav' => include TEMPLATE . 'nav.php',
    'article' => include TEMPLATE . 'hero.php',
    'footer' => include TEMPLATE . 'footer.php'
];

include ROOT . 'src/Layouts/Layout.php';

$time_spent['serving_page'] = (microtime(true) - $t);

//-------------------------------------------------------------------- debug
require ROOT . 'src/Helpers/DebugInfo.php';

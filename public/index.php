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
 *   - [x] Redirect to parameterized index.php
 *   - [x] Use Dispatcher to call Controller/Action/Param
 *   - [x] Use Controller to request, filter, hand over Model data
 *   - [x] Use View to compose model data over layout, template
 *     + [x] Inline css, js when rendering layout, templates
 *   - [x] Plug in Model
 *     + [ ] Use Validatable interface to check Entity going in and out
 *   - [x] Use a configuration file
 *     + [x] Define a named constant to force config update
 *   - [x] Implement a simple file cache
 *     + [ ] Allow for Controller, Model, View to invalidate cached files
 *     + [ ] Handle getting hammered with requests that resolve to a valid
 *           Controller but end up swamping the cache because of distinct
 *           query strings filled with junk parameters
 *     + [x] Handle requests resolving to super long file name more gracefully
 *     + [x] Check if all characters allowed in a query string are valid in
 *           a filename
 *       - [ ] Consider a rewrite rule or some validation
 *     + [x] Use the configured components as controller white list
 *     + [x] Use existing controller methods as an action white list
 *   - [x] Consider supporting Deferred components that are rendered via Js 
 *         hooks and placeholders after all regular components are fist pushed 
 *         and painted.
 *   - [x] Consider Deferred components via Js/Ajax
 *   - [ ] Test run Templates using and rendering other Templates
 *   - [ ] Add a project specific QueryString builder to simplify link creation
 *   - [ ] Write the test suite Entity->isValid(), validate() deserves
 *   - [ ] Investigate CORS issue with font preloading
 */

declare(strict_types=1);

define('ROOT', str_replace('public', '', __DIR__));
define('DEV_FORCE_CONFIG_UPDATE', true);
define('DEV_GLOBALS_DUMP', true);

require ROOT . 'src/Helpers/AutoLoader.php';

use Helpers\Dispatcher;
use Entities\Entity;
use Helpers\Cache;
use Helpers\CacheItem;
//--------------------------------------------------------------- playground

//------------------------------------------------------------------ session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    /* generate a CRSF guard token */
    if (empty($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }

    /**
     * note
     *   Add an hidden input in forms :
     * 
     *     <input type="hidden" name="token" value="{$_SESSION['token']} />
     * 
     *   Verify token :
     * 
     *     if (!empty($_POST['token'])) {
     *         if (hash_equals($_SESSION['token'], $_POST['token'])){
     *             // good to go
     *         } else {
     *             // something might be up
     *         }
     *     }
     *   
     * 
     *   Use per form :
     *     
     *     hash_hmac('sha256', '/form.php', $_SESSION['another_token']);
     * 
     *     ( see available crypto algos with hash_hmac_algos() )
     */
}
//------------------------------------------------------------------- config
require ROOT . 'src/Helpers/Config.php';
date_default_timezone_set('Europe/Paris');
//--------------------------------------------------------------- playground
// echo is_file($file = 'index.php');
// echo $file;

// echo time() . '<br/>';
// echo gettype(time()) . '<br/>';

// $distribution_factor = 1;
// $render_time = 0.004;
// $log_odd = log(mt_rand() / mt_getrandmax());
// echo time() - $render_time * $distribution_factor * $log_odd;
// exit;

// use Entities\User;

// $test_entity = new User(
//     '10', //strval(rand(0, 9999)).
//     'D' . str_shuffle('ubois') . ' de la M' . str_shuffle('oquette'),
//     'Jdean-Mi' . str_shuffle('michelou'),
//     date('Y-m-d'). 'xdf',
//     strval(rand(1111111111, 9999999999)).'f',
//     'jean-mi' . strval(rand(11, 999)) . '@@caramail.com'
// );

// $t = microtime(true);
// echo '<pre>'.var_export($test_entity->isValid(), true).'</pre><hr />';
// echo '<pre>'.var_export($test_entity->getData(), true).'</pre><hr />';
// echo '<pre>'.var_export($test_entity->getDefinitions(), true).'</pre><hr />';
// echo '<pre>'.var_export($test_entity->getFiltered(), true).'</pre><hr />';
// echo '<pre>'.var_export($test_entity->validate()->getData(), true).'</pre><hr />';
// echo (microtime(true) - $t);


// define('TEMPLATE', ROOT . 'src/Templates/');

// $hero = [
//     'content' => include TEMPLATE . 'cta_newsletter.php'
// ];

// $layout = [
//     'title' => 'Yacht Share Prestige',
//     'nav' => include TEMPLATE . 'nav.php',
//     'article' => include TEMPLATE . 'hero.php',
//     'footer' => include TEMPLATE . 'footer.php'
// ];

// include ROOT . 'src/Layouts/Layout.php';
//---------------------------------------------------------------------- run
$t = microtime(true);

$dispatcher = new Dispatcher($config);
// $dispatcher->route()->cache();
// $dispatcher->route();

$time_spent['serving_page'] = (microtime(true) - $t);

//------------------------------------------------------------------- config
require ROOT . 'src/Helpers/SerializeConfig.php';
//-------------------------------------------------------------------- debug
require ROOT . 'src/Helpers/DebugInfo.php';


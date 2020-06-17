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
use Entities\User;
use Entities\UserD;
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
// echo get_class(time()) . '<br/>';

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

echo '' . date('Y-m-d H:i:s');

use Models\ComparOperatorAPI;

// $controller = new Home(['db_configs' => $config['db_configs']]);
// $pdo = new DBPDO($controller);
$pdo = ComparOperatorAPI::fromConfig($config['db_configs']);
// class SuperUseless {

// }
echo '//--------------------------------------------------------------<br />';
// $users = $pdo->execute(
//     'comparoperator',
//     "SELECT
//         `user_id`,
//         `name`,
//         `created_at`,
//         `ip`
//      FROM `users`",
//     NULL,
//     [\PDO::FETCH_CLASS, '\Entities\User']
//     // [\PDO::FETCH_COLUMN]
// );
// // echo '<pre>' . var_export($users, true) . '</pre><hr />';
// echo '<br />' . get_class($users[0]);
echo '//--------------------------------------------------------------<br />';
// $users = $pdo->execute(
//     'comparoperator',
//     "SELECT
//         `user_id`,
//         `name`,
//         `created_at`,
//         `ip`
//      FROM `users`",
//     NULL,
//     [\PDO::FETCH_ASSOC | \PDO::FETCH_FUNC, function (...$row_data) {
//         return User::fromData($row_data);
//         // echo '<pre>'.var_export($row_data, true).'</pre><hr />';
//     }]
// );
// echo '<pre>' . var_export($users, true) . '</pre><hr />';
// echo '<br />' . get_class($users[0]);




$iterations = 10;
$i   = 0;
// while ($i < $iterations) {

//     // $a = $test_entity->getData();
//     // $test_entity->user_id = $i;
//     $users = $pdo->execute(
//         'comparoperator',
//         "INSERT INTO
//         `users` (`name`, `created_at`, `ip`)
//     VALUES
//         (?, '2020-05-16 14:48:18', 0xac10ee01);",
//         ['rando'.$i],
//     );
//     ++$i;
// }

echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;

while ($i < $iterations) {

    // $a = $test_entity->getData();
    // $test_entity->user_id = $i;
    $users = $pdo->execute(
        'comparoperator',
        "SELECT
            `user_id`,
            `name`,
            `created_at`,
            `ip`
         FROM `users`",
        NULL,
        [\PDO::FETCH_CLASS, '\Entities\UserP']
    );
    $user_index =  $i % count($users);
    $filtered = $users[$user_index]->getFiltered();
    $data_array = $users[$user_index]->getData();
    ++$i;
}
echo '<pre>'.var_export(count($users), true).'</pre><hr />';
echo '<pre>' . var_export('from Query User w Properties: ' . (microtime(true) - $t), true) . '</pre>';
// echo '<pre>' . var_export($users[0], true) . '</pre><hr />';
// echo '<pre>' . var_export($data_array, true) . '</pre><hr />';
// echo '<pre>' . var_export($filtered, true) . '</pre><hr />';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;

while ($i < $iterations) {

    // $a = $test_entity->getData();
    // $test_entity->user_id = $i;
    $raw_users = $pdo->execute(
        'comparoperator',
        "SELECT
            `user_id`,
            `name`,
            `created_at`,
            `ip`
         FROM `users`",
    );
    $users = [];
    // foreach($raw_users as $raw_user) {
    for($u = 0, $count = count($raw_users); $u < $count; $u++) {
        $users[] = new User($raw_users[$u]);
    }
    $user_index =  $i % count($users);
    $filtered = $users[$user_index]->getFiltered();
    $data_array = $users[$user_index]->getData();
    ++$i;
}
echo '<pre>'.var_export(count($users), true).'</pre><hr />';
echo '<pre>' . var_export('from Query User w Assoc Array for : ' . (microtime(true) - $t), true) . '</pre>';
// echo '<pre>' . var_export($users[0], true) . '</pre><hr />';
// echo '<pre>' . var_export($data_array, true) . '</pre><hr />';
// echo '<pre>' . var_export($filtered, true) . '</pre><hr />';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;

while ($i < $iterations) {

    // $a = $test_entity->getData();
    // $test_entity->user_id = $i;
    $raw_users = $pdo->execute(
        'comparoperator',
        "SELECT
            `user_id`,
            `name`,
            `created_at`,
            `ip`
         FROM `users`",
    );
    $users = [];
    foreach($raw_users as $raw_user) {
        $users[] = new User($raw_user);
    }
    $user_index =  $i % count($users);
    $filtered = $users[$user_index]->getFiltered();
    $data_array = $users[$user_index]->getData();
    ++$i;
}
echo '<pre>'.var_export(count($users), true).'</pre><hr />';
echo '<pre>' . var_export('from Query User w Assoc Array fe : ' . (microtime(true) - $t), true) . '</pre>';
// echo '<pre>' . var_export($users[0], true) . '</pre><hr />';
// echo '<pre>' . var_export($data_array, true) . '</pre><hr />';
// echo '<pre>' . var_export($filtered, true) . '</pre><hr />';

$iterations = 100;
$count = 1016;
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;

while ($i < $iterations) {

    // $a = $test_entity->getData();
    // $test_entity->user_id = $i;
    $users = [];
    for ($j = 0; $j < $count; $j++) {
        $users[] =  \Entities\UserP::fromDataAsProperties(
            [
                'user_id' => $j,
                'name' => 'El Guapo',
                'created_at' =>  date('Y-m-d H:i:s'),
                'ip' => inet_pton('127.0.0.1'),
            ]
        );
    }
    // $user_index =  $i % count($users);
    // $filtered = $users[$user_index]->getFiltered();
    // $data_array = $users[$user_index]->getData();
 
    ++$i;
}
echo '<pre>'.var_export(count($users), true).'</pre><hr />';
echo '<pre>' . var_export('from Data User w Properties : ' . (microtime(true) - $t), true) . '</pre>';
// echo '<pre>' . var_export($users[0], true) . '</pre><hr />';
// echo '<pre>' . var_export($data_array, true) . '</pre><hr />';
// echo '<pre>' . var_export($filtered, true) . '</pre><hr />';
echo '//--------------------------------------------------------------<br />';
$t = microtime(true);
$i   = 0;

while ($i < $iterations) {

    // $a = $test_entity->getData();
    // $test_entity->user_id = $i;
    $users = [];
    for ($j = 0; $j < $count; $j++) {
        $users[] =  new \Entities\User(
            [
                'user_id' => $j,
                'name' => 'El Guapo',
                'created_at' =>  date('Y-m-d H:i:s'),
                'ip' => inet_pton('127.0.0.1'),
            ]
        );
    }
    $user_index =  $i % count($users);
    $filtered = $users[$user_index]->getFiltered();
    $data_array = $users[$user_index]->getData();
 
    ++$i;
}
echo '<pre>'.var_export(count($users), true).'</pre><hr />';
echo '<pre>' . var_export('from Data User w Assoc Array: ' . (microtime(true) - $t), true) . '</pre>';
// echo '<pre>' . var_export($users[0], true) . '</pre><hr />';
echo '<pre>' . var_export($data_array, true) . '</pre><hr />';
echo '<pre>' . var_export($filtered, true) . '</pre><hr />';

// echo '//--------------------------------------------------------------<br />';
// $t = microtime(true);
// $i   = 0;
// 
// while ($i < $iterations) {

//     $users = $pdo->execute(
//         'comparoperator',
//         "SELECT
//             `user_id`,
//             `name`,
//             `created_at`,
//             `ip`
//          FROM `users`",
//         NULL,
//         [\PDO::FETCH_ASSOC | \PDO::FETCH_FUNC, function (...$row_data) {
//             echo '<pre>'.var_export($row_data, true).'</pre><hr />';
//             return new UserD($row_data);
//         }]
//     );
//     // $filtered = $users[$i]->getFiltered();
//     $data_array = $users[$i]->getData();
//     ++$i;
// }
// echo '<pre>' . var_export('UserD : ' . (microtime(true) - $t), true) . '</pre>';
// echo '<pre>' . var_export($users[0], true) . '</pre><hr />';
// echo '<pre>' . var_export($data_array, true) . '</pre><hr />';
// echo '<pre>' . var_export($filtered, true) . '</pre><hr />';
// echo '<pre>'.var_export($a, true).'</pre><hr />';
// echo '<pre>'.var_export($b, true).'</pre><hr />';
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

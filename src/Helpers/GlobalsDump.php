<?php

declare(strict_types=1);

// namespace Helpers;


?>
<!-- <hr />
<form action="" method="POST">
    <input type="submit" name="killsession" value="Kill Session" />
</form>
<form action="" method="POST">
    <input type="submit" name="clearcache" value="Clear Cache" />
</form> -->


<?php
if (isset($_POST['killsession'])) {
    $_SESSION = [];
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_destroy();
    }
}

if (isset($_POST['clearcache'])) {
    $dispatcher->clearCache();
}

if (DEV_GLOBALS_DUMP) {
    // toss sensitive stuff before dumping $GLOBALS
    unset($config);
    foreach ($GLOBALS['_ENV'] as $key => $value) {
        if (preg_match('/pass/i', $key)) {
            $GLOBALS['_ENV'][$key] = '****************';
        }
    }
    foreach ($GLOBALS['_SERVER'] as $key => $value) {
        if (preg_match('/pass/i', $key)) {
            $GLOBALS['_SERVER'][$key] = '****************';
        }
    }

    // hello opcache
    $op_cache_status = opcache_get_status();
    $loaded_extensions = get_loaded_extensions();

    echo '<hr />';
    prettyDump($GLOBALS);
}

echo '<hr />';
echo "<pre>running          : {$_SERVER['HTTP_USER_AGENT']}</pre>";
echo "<pre>user ip          : {$_SERVER['REMOTE_ADDR']}</pre>";
echo "<pre>server name      : {$_SERVER['SERVER_NAME']}</pre>";
echo '<pre>memory usage     : ' . memory_get_usage() . ' bytes</pre>';
// echo '<pre>'.var_export($GLOBALS, TRUE).'</pre>';
// phpinfo();

<?php

declare(strict_types=1);

namespace Helpers;

use Controllers\Controller;
use Interfaces\Loadable;

/**
 * Translate and dispatch a QUERY_STRING to the appropriate Controller or serve
 * a valid cached version of the pages if one is available.
 * 
 * Accept queries formatted as follow :
 * index.php?controller=ControllerName&action=ActionName&p1=v1&p2=v2&pn=vn"
 * 
 * Provide fallback routes for incomplete or junk queries.
 * 
 * note
 *   Dispatcher is not in charge of invalidating cache files.
 *   If a cache file exists and is not past its expiration date, it is 
 *   considered valid and Dispatcher will serve it.
 */
class Dispatcher
{
    protected $request;

    /**
     * @var Loadable
     */
    protected $controller;

    /**
     * var array ['route_name' => route]
     */
    protected $routes;

    // const CACHE_TTL = 30; /* seconds */
    // const CACHE_PATH = ROOT . 'cache/';

    /**
     * Create a new Dispatcher instance.
     *
     * @param  array $config
     * @return void
     * 
     * @todo Consider making a set 
     *       ( or a ghetto-set e.g., [component => bool $is_instantiable] )
     *       out of registered components instead of an array.
     * 
     * @todo Bench break even count of registered components for 
     *       isset/array_key_exists vs in_array.
     */
    public function __construct(array $config)
    {
        parse_str($_SERVER['QUERY_STRING'], $this->request);

        /**
         * Validate query against whitelist of registered components
         * Assert that the controller is instantiable
         * Redirect to Home if query string specifies junk controller
         */
        if ((!isset($this->request['controller'])
            || (!in_array(
                    $this->request['controller'],
                    $config['components']['Controllers'],
                    true
                )))) {

            /**
             * note
             *   If you need to remember this redirection happened :
             *     Compare QUERY_STRING and REQUEST_URI :wink:
             **/
            $this->request['controller'] = 'Home';
            $_SERVER['QUERY_STRING'] = 'controller=Home';
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SERVER['HTTP_X_HTTP_METHOD'])) {
            $this->request['method'] = $_SERVER['HTTP_X_HTTP_METHOD'];
        } else {
            $this->request['method'] = $_SERVER['REQUEST_METHOD'];
        }

        /* sanitize */
        $base_name = rawurlencode($_SERVER['QUERY_STRING']);

        /* no need to default to index anymore */
        // if ($base_name === '') {
        //     $base_name = 'index';
        // }

        $this->request['db_configs'] = $config['db_configs'];
        $this->request['cached_file'] =
            substr(self::CACHE_PATH . $base_name, 0, 250) . '.html';
    }

    /**
     * @todo
     *   - [x] Figure out how to prevent a call to a method that does
     *         NOT represent an action ?!
     *     + [x] Consider prepending / appending with 'run' or Action' 
     *           both to make it clear what is meant to be a callable 
     *           action and thwart malicious requests
     * @todo Move the controller instancing logic to a method in Controller base
     *       class that returns the appropriate Controller all setup with given
     *       request as args.
     */
    public function route(): self
    {
        if ($this->isCached()) {
            // echo 'Serving Cached !';
            readfile($this->request['cached_file']);
        } else {
            // echo 'Serving Fresh !';
            /* 'escaping' and providing default action */
            $this->request['action'] =
                'run' . ($this->request['action'] ?? 'Default');

            /* use existing controller or load one */
            if (method_exists(
                $this->controller ?? $this->load(),
                $this->request['action']
            )) {
                /* requested action exists, run it */
                $this->controller->{$this->request['action']}($this->request);
            } else {
                /* run default action */
                $this->request['action'] = 'runDefault';
                $this->controller->runDefault($this->request);
            }
        }

        return $this;
    }

    /**
     * @todo Move the controller instancing logic to a method in Controller base
     *       class that returns the appropriate Controller all setup with given
     *       request as args.
     */
    public function load(): Controller
    {
        $controller_name = '\Controllers\\' . $this->request['controller'];
        unset($this->request['controller']);
        $this->controller = new $controller_name();

        return $this->controller;
    }

    /**
     * @todo Use Cache class
     * 
     * note
     *   This is short-circuited until upgraded Cache is plugged in.
     */
    public function isCached(): bool
    {
        return false;
    }
}

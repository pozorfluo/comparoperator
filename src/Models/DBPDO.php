<?php

/**
 * 
 */

declare(strict_types=1);

namespace Models;

use Exception;
use Helpers\DB;
use Controllers\Controller;

/**
 * 
 */
class DBPDO extends Model
{
    protected $db;

    /**
     * Define defaults, take arguments
     */
    public function __construct(Controller $controller)
    {
        parent::__construct($controller);

        $this->db = new DB($this->args['db_configs']);
    }


    /**
     *
     */
    public function useConfig(string $config_name): ?DB
    {
        if ($this->db->connected_to === $config_name) {
            return $this->DB;
        } else {
            return $this->db->connect($config_name);
        }
    }

    /**
     * 
     */
    public function execute(
        string $config_name,
        string $query,
        ?array $args = NULL,
        bool $transaction = false
    ): ?array {

        // if (!is_null($this->useConfig($config_name))) {
            // $t = microtime(true);
            if ($this->db->connected_to !== $config_name) {
               $this->db->connect($config_name);
            }
            // echo '<pre>connect ' . var_export((microtime(true) - $t), true) . '</pre><hr />';
            /**
             *  todo 
             *    - [ ] Sanitize here !
             */
            if ($transaction) {
                return $this->db->transaction($query, $args);
            } else {
                // $t = microtime(true);
                $statement = $this->db->query($query, $args);
                // $res = $statement->fetchAll();
                // echo '<pre>queryFetch ' . var_export((microtime(true) - $t), true) . '</pre><hr />';
                // return $res;
                return $statement->fetchAll();
            }
        // }
        // echo '<pre>HelloPdo->execute() error : Could not select db.</pre>';
        return null;
    }
}

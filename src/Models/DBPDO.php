<?php

/**
 * 
 */

declare(strict_types=1);

namespace Models;

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
        array $options = [],
        bool $transaction = false
    ): ?array {
            if ($this->db->connected_to !== $config_name) {
               $this->db->connect($config_name);
            }
            /**
             *  todo 
             *    - [ ] Sanitize here !
             */
            if ($transaction) {
                return $this->db->transaction($query, $args);
            } else {
                $statement = $this->db->query($query, $args);
                return $statement->fetchAll(...$options);
            }
        // }
        // echo '<pre>HelloPdo->execute() error : Could not select db.</pre>';
        return null;
    }
}

<?php

/**
 * 
 */

declare(strict_types=1);

namespace Entities;

use Interfaces\Validatable;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;

/**
 * note
 *   Default filter only allows a string containing 
 *   A-Z, a-z, 0-9, space, underscore, dash
 * 
 * see https://www.php.net/manual/en/function.filter-var-array.php
 */
class Entity implements Validatable
{
    /**
     * [ string $field_name => mixed $value ]
     */
    protected $data;

    /**
     * [ string $field_name => mixed $filter_definition ]
     */
    protected $definitions;
    protected $is_valid;
    /**
     * 
     */
    public function __construct(array $data, array $definitions = [])
    {
        $this->data = $data;

        foreach (array_keys($data) as $field) {
            $this->definitions[$field] = isset($definitions[$field])
                ? $definitions[$field]
                : [
                    'filter' => FILTER_VALIDATE_REGEXP,
                    'options' => ['regexp' => '/^([A-Za-z0-9_\-\s]+)$/']
                ];

            // echo '<pre>' . var_export($this->definitions[$field], true) . '</pre>';
        }
    }

    /**
     * 
     */
    public function getData(): array
    {
        return $this->data;
    }
    public function getDefinitions(): array
    {
        return $this->definitions;
    }

    /**
     * note
     *   Casting $field to bool is not satisfactory given php behaviour
     * 
     *   Use strict comparison against false or NULL as filter_var_array yields 
     *   a filtered value, false or NULL for missing keys 
     * 
     *   See https://www.php.net/manual/en/types.comparisons.php
     * */
    public function isValid(): bool
    {
        return $this->is_valid ?? !in_array(
            false,
            filter_var_array($this->data, $this->definitions),
            true // strict
        );
    }

    /**
     * Return filtered data, do not change internal state
     */
    public function getFiltered(): array
    {
        return filter_var_array($this->data, $this->definitions);
    }

    /**
     * Apply filters
     * 
     * note
     *   Raw data of a field is lost if its filter fails !
     */
    public function validate(): self
    {
        $this->data = filter_var_array($this->data, $this->definitions);
        $this->is_valid = !in_array(
            false,
            filter_var_array($this->data, $this->definitions),
            true // strict
        );
        return $this;
    }
}

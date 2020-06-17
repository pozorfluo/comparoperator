<?php

/**
 * 
 */

declare(strict_types=1);

namespace Entities;

/**
 * 
 */
class User extends Entity
{
    /**
     * @var int
     */
    public $user_id;
    /**
     * @var string
     */
    public  $name =  '';
    /**
     * @var string
     */
    public  $created_at =  '';
    /**
     * @var string
     */
    public  $ip =  '';

    protected $definitions =
    [
        'user_id' => [
            'filter' => FILTER_VALIDATE_INT,
            'options' => [
                'min_range' => 1,
                'max_range' => 16777215
            ]
        ],
        'name' => [
            'filter' => FILTER_VALIDATE_REGEXP,
            'options' => ['regexp' => '/^([A-Za-z0-9_\-\s]+)$/']
        ],
        'created_at' => [
            'filter' => FILTER_VALIDATE_REGEXP,
            'options' => [
                /**
                 * @note
                 *   This validates the format but does NOT check for
                 *   impossible dates.
                 */
                'regexp' => '/^[0-9]{4}-[0-1][0-9]-[0-3][0-9] [0-2][0-9]:[0-5][0-9]:[0-5][0-9]$/'
            ]
        ],
        'ip' => [
            'filter' => FILTER_VALIDATE_IP,
            'flags' => FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6
        ]
    ];

    function __construct()
    {
    }

    public function getData(): array
    {
        return [
            'user_id' => $this->user_id,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'ip' => inet_ntop($this->ip),
        ];
    }

    /**
     * Return filtered data, do not change internal state
     */
    public function getFiltered(): array
    {
        return filter_var_array($this->getData(), $this->definitions);
    }
}
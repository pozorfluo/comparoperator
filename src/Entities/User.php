<?php

declare(strict_types=1);

namespace Entities;

/**
                 * 
                 */
class User extends Entity
{
    /**
                 * @var array [ string $field_name => mixed $filter_definition ]
     */
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
            'filter' => FILTER_CALLBACK,
            'options' => 'inet_ntop'
        ]
    ];

    /**
     * List of field names required for insertion in database.
     * 
     * @var array string[]
     */
    protected $required_fields = [
        'name',
        'created_at',
        'ip'
    ];

    /**
     * @param  array $data [ string $field_name => mixed $value ]
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }
}

<?php

/**
 * 
 */

declare(strict_types=1);

namespace Entities;

/**
 * 
 */
class Location extends Entity
{
    /**
     * @var array [ string $field_name => mixed $filter_definition ]
     */
    protected $definitions =
    [
        'name' => [
            'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        ],
        'thumbnail' => [
            'filter' => FILTER_VALIDATE_REGEXP,
            'options' => ['regexp' => '/^(?!.*--|.*\/\/|.*\\\\\\\\|.*\.\.)[\\\\\/A-Za-z0-9_\-\.]+\.(?:jpg|jpeg|gif|svg|webp|png)$/'],
            // ^(?!.*--|.*\/\/)(?!.*\.\.)[\\\/A-Za-z0-9_\-\.]+\.(?:jpg|jpeg|gif|svg|webp|png)$
            // ^(?!.*--)(?!.*\/\/)(?!.*\.\.)[\\\/A-Za-z0-9_\-\.]+\.(?:jpg|jpeg|gif|svg|webp|png)$
        ],
        'offering_count' => [
            'filter' => FILTER_VALIDATE_INT
        ]
    ];

    /**
     * @param  array $data [ string $field_name => mixed $value ]
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }
}

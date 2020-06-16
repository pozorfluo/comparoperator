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
                         * 
                         */
    function __construct(
        int $user_id,
        string $name =  '',
        string $created_at =  '',
        string $ip =  ''
    ) {
        parent::__construct(
            [
                'user_id' => $user_id,
                'name' => $name,
                'created_at' => $created_at,
                'ip' => $ip
            ],
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
            ]
        );
    }
}

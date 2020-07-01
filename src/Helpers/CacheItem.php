<?php

declare(strict_types=1);

namespace Helpers;

use Controllers\Controller;

/**
 * Describe a cached item metadata.
 * 
 * Used in a Cache trove map.
 * 
 * note
 *   CacheItem does NOT hold the actual cached value/data, only metadata.
 *   
 *   Actual cached value/data is stored in file named as follow :
 *     Cache::CACHE_PATH . CacheItem->filename . '.' .Cache->name
 *   
 */
class CacheItem
{

    /**
     * Random unique filename attributed to this cached item.
     *
     * @var string
     */
    public $filename;
    
    /**
     * Time spent rendering this CacheItem.
     * 
     * Used to modulate Early Expiration trigger.
     *
     * @var float
     */
    public $render_time;
    
    
    /**
     * This CacheItem best before date as a Unix timestamp.
     * 
     * Early Expiration may happen before that expiry date.
     *
     * @var int
     */
    public $expiry_date;
    
    /**
     * Optional tag list used for bulk invalidation.
     *
     * @var array [string]
     */
    public $tags = [];

    /**
     * Token counter used to decide if a CacheItem is due for pre-emptive 
     * re-rendering.
     *
     * @var int
     */
    public $popularity = 1;

    /**
     * Create a new CacheItem instance from a json encoded representation.
     * 
     * @todo See why bench-cache-serialization is NOT using associative array
     *       decoding option.
     * 
     * @param  string $json_data
     * @return CacheItem
     */
    public static function fromJson(string $json_data): CacheItem
    {
        $json_data = json_decode($json_data, true);
        return new self(
            $json_data['filename'],
            $json_data['render_time'],
            $json_data['expiry_date'],
            $json_data['popularity'],
            $json_data['tags']
         );
    }

    /**
     * Create a new CacheItem instance.
     * 
     * @param string $filename
     * @param array $tags
     * @param int $popularity
     * @param float $render_time
     * 
     * @return void
     */
    public function __construct(
        string $filename,
        float $render_time,
        int $expiry_date,
        int $popularity = 1,
        array $tags = []
    ) {
        $this->filename = $filename;
        $this->render_time = $render_time;
        $this->expiry_date = $expiry_date;
        $this->tags = $tags;
        $this->popularity = $popularity;
    }
}

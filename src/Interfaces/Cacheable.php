<?php

/**
 * 
 */

declare(strict_types=1);

namespace Interfaces;

/**
 * Describe the interface necessary for the output of component to be considered
 * Cacheable by the Dispatcher or when pre-emptively re-rendering a page.
 * 
 * @todo Change return type hint for cache() to Controller if no other type are
 *       used.
 */
interface Cacheable
{
    /**
     * 
     */
    public function cache(): object;
}

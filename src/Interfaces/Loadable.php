<?php

/**
 * 
 */

declare(strict_types=1);

namespace Interfaces;

/**
 * Describe the interface necessary for a component to be considered Loadable
 * by the Dispatcher or when pre-emptively re-rendering a page.
 * 
 * @todo Change return type hint for load() to Controller if no other type are
 *       used.
 */
interface Loadable
{
    /**
     * 
     */
    public function load(): object;
}

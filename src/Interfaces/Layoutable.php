<?php

/**
 * 
 */

declare(strict_types=1);

namespace Interfaces;

/**
 * 
 */
interface Layoutable
{
    /**
     * 
     */
    public function getRaw(): array;

    /**
     * Render components
     *   -> [string name => string rendered component]
     */
    public function render(): array;

    /**
     * 
     */
    public function compose();
}

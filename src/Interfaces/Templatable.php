<?php

/**
 * 
 */

declare(strict_types=1);

namespace Interfaces;

/**
 * 
 */
interface Templatable
{
    /**
     * 
     */
    public function getRaw(): array;

    /**
     * 
     */
    public function render(): string;
}

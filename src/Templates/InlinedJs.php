<?php

/**
 * 
 */

declare(strict_types=1);

namespace Templates;

use Interfaces\Templatable;

/**
 * 
 */
class InlinedJs implements Templatable
{
    protected $data;

    /**
     * 
     */
    public function __construct(
        array $paths = ['resources/js/script.min.js']
    ) {
        $this->data = $paths;
    }

    /**
     * 
     */
    public function getRaw(): array
    {
        return $this->data;
    }

    /**
     * 
     */
    public function render(): string
    {
        $rendered_template = '<script>';
        
        foreach ($this->data as $path) {
            $rendered_template .= file_get_contents($path);
        }

        $rendered_template .= '</script>';
        return $rendered_template;
    }
}

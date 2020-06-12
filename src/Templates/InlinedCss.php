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
class InlinedCss implements Templatable
{
    protected $data;

    /**
     * 
     */
    public function __construct(
        array $paths = ['resources/css/style.min.css']
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
        $rendered_template = '<style>';
        
        foreach ($this->data as $path) {
            $rendered_template .= file_get_contents($path);
        }

        $rendered_template .= '</style>';
        return $rendered_template;
    }
}

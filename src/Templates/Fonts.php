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
class Fonts implements Templatable
{
    protected $data;

    /**
     * 
     */
    public function __construct(
        array $fonts = ['resources/fonts/font-ibmplexsans.min.phtml']
    ) {
        $this->data = $fonts;
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
        $rendered_template = '';
        foreach ($this->data as $path) {
            $rendered_template .= file_get_contents($path);
        }
        
        return $rendered_template;
    }
}

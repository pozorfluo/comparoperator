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
class Footer implements Templatable
{
    protected $data;

    /**
     * 
     */
    public function __construct(
        array $links = ['Project Name' => 'index.php?controller=Home']
    ) {
        $this->data = $links;
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
        $rendered_template = '<hr /><footer>';
        foreach ($this->data as $link => $href) {

            $rendered_template .=
<<<TEMPLATE
<a href="{$href}">
    <div class="nav-button">
        {$link}
    </div>
</a>
TEMPLATE;
        }

        $rendered_template .= '</footer>';
        return $rendered_template;
    }
}

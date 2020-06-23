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
class Table implements Templatable
{
    protected $data;

    /**
     * todo
     *   - [ ] Hook some Js to sort columns
     */
    public function __construct(
        array $entries = [['a' => '-', 'b' => '-', 'c' => '-', 'd' => '-']],
        string $class = 'query',
        bool $deferred = false
    ) {
        $this->data['entries'] = $entries;
        $this->data['class'] = $class;
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
        $class = $this->data['class'];

        $rendered_template =
            <<<TEMPLATE
                <table class="{$class}">
                <thead class="{$class}">
                <tr class="{$class}">
                TEMPLATE;

        /* table header */
        foreach (array_keys($this->data['entries'][0]) as $header) {

            $rendered_template .=
                <<<TEMPLATE
                    <th class="{$class}">{$header}</th>
                    TEMPLATE;
        }


        $rendered_template .= '</tr></thead><tbody>';

        /* table header */
        foreach ($this->data['entries'] as $entry) {

            $rendered_template .=
                <<<TEMPLATE
                    <tr class="{$class}">
                    TEMPLATE;

            foreach ($entry as $col => $value) {
                $rendered_template .=
                    <<<TEMPLATE
                        <td class="{$class}">{$value}</a></td>
                        TEMPLATE;
            }

            $rendered_template .=  '</tr>';
        }
        $rendered_template .= '</tbody></table>';


        return $rendered_template;
    }
}

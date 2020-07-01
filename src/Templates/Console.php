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
class Console implements Templatable
{
    protected $data;

    /**
     * 
     */
    public function __construct(
        array $content,
        string $class = 'console',
        int $row_count = 10,
        int $col_count = 90,
        int $max_length = 2000,
        string $id = 'hook-console',
        bool $readonly = true,
        string $placeholder = '...'
        // bool $deferred = false
    ) {
        $this->data = [
            'content' => implode('&#13;&#10;', $content),
            'class' => $class,
            'row_count' => $row_count,
            'col_count' => $col_count,
            'max_length' => $max_length,
            'id' => $id,
            'readonly' => $readonly ? 'readonly' : '',
            'placeholder' => $placeholder,
        ];
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
        return <<<TEMPLATE
<textarea id="{$this->data['id']}"  
            class="{$this->data['class']}"  
            cols="{$this->data['col_count']}"
            rows="{$this->data['row_count']}" 
            maxlength="{$this->data['max_length']}"
            style="white-space: pre-line;"
            placeholder="{$this->data['placeholder']}"
            {$this->data['readonly']}>
            {$this->data['content']}
</textarea> 
TEMPLATE;
    }
}

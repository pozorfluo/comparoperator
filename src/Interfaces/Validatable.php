<?php

/**
 * 
 */

declare(strict_types=1);

namespace Interfaces;

/**
 * 
 */
interface Validatable
{
    /**
     * [ string $field_name => mixed $value ]
     */
    public function getData(): array;

    /**
     * [ string $field_name => mixed $filter_definition ]
     */
    public function getDefinitions(): array;

    /**
     * 
     */
    public function isValid(): bool;

    /**
     * Return filtered data, do not change internal state.
     */
    public function getFiltered(): array;

    /**
     * Apply filters.
     * 
     * @note
     *   Raw data of a field is lost if its filter fails !
     */
    public function validate();
}

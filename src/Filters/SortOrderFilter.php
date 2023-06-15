<?php

namespace AllrivalSDK\Filters;

use AllrivalSDK\Filters\FilterTypes\OnlyExplicitValuesFilter;

/**
 * Указывается порядок сортировки по возрастанию или убыванию
 */
class SortOrderFilter extends OnlyExplicitValuesFilter
{
    // По возрастанию
    public const ASC = 'ASC';

    // По убыванию
    public const DESC = 'DESC';

    public function getStringQuery(): string
    {
        return "filter[" . $this->getName() . "]=" . $this->value;
    }

    protected string $name = '_sort_order';
}
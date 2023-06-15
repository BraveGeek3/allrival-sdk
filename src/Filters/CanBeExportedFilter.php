<?php

namespace AllrivalSDK\Filters;

use AllrivalSDK\Filters\FilterTypes\BooleanFilter;

/**
 * Экспортирование не запрещено
 */
class CanBeExportedFilter extends BooleanFilter
{
    protected string $name = 'canBeExported';
}
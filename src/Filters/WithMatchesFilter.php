<?php

namespace AllrivalSDK\Filters;

use AllrivalSDK\Filters\FilterTypes\BooleanFilter;

/**
 * С найденными аналогами у конкурентов
 */
class WithMatchesFilter extends BooleanFilter
{
    protected string $name = 'with_matches';
}
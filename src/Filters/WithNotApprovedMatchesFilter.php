<?php

namespace AllrivalSDK\Filters;

use AllrivalSDK\Filters\FilterTypes\BooleanFilter;

/**
 * C необработанными совпадениями
 */
class WithNotApprovedMatchesFilter extends BooleanFilter
{
    protected string $name = 'with_not_approved_matches';

}
<?php

namespace AllrivalSDK\Filters;

use AllrivalSDK\Filters\FilterTypes\BooleanFilter;
use AllrivalSDK\Filters\FilterTypes\OnlyExplicitValuesFilter;

/**
 * Есть сопоставленные товары, которые не в наличии
 */
class WithDisabledProductMatchesFilter extends BooleanFilter
{
    protected string $name = 'with_disabled_product_matches';
    //да/нет
}
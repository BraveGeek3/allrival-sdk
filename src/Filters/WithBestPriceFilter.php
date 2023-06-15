<?php

namespace AllrivalSDK\Filters;

use AllrivalSDK\Filters\FilterTypes\BooleanFilter;

/**
 * С лучшей ценой
 */
class WithBestPriceFilter extends BooleanFilter
{
    protected string $name = 'best_price';
}
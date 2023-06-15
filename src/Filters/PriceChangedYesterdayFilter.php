<?php

namespace AllrivalSDK\Filters;

use AllrivalSDK\Filters\FilterTypes\BooleanFilter;

/**
 * Цена на товар изменилась вчера
 */
class PriceChangedYesterdayFilter extends BooleanFilter
{
    protected string $name = 'price_changed_yesterday';
}
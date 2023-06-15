<?php

namespace AllrivalSDK\Filters;

use AllrivalSDK\Filters\FilterTypes\BooleanFilter;

/**
 * Цена на товар конкурента изменилась вчера
 */
class RivalPriceChangedYesterdayFilter extends BooleanFilter
{
    protected string $name = 'rival_price_changed_yesterday';

}
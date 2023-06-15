<?php

namespace AllrivalSDK\Filters;

use AllrivalSDK\Filters\FilterTypes\InequalityFilter;

/**
 * Отклонение от рекомендуемой цены
 */
class DeviationFromRecommendedPriceFilter extends InequalityFilter
{
    protected string $name = 'deviation_from_recommended_price_percent';

}
<?php

namespace AllrivalSDK\Filters;

use AllrivalSDK\Filters\FilterTypes\InequalityFilter;

/**
 * Цена конкурента
 */
class SimilarProductPriceFilter extends InequalityFilter
{
    protected string $name = 'centerCluster__entryProduct__price';

}
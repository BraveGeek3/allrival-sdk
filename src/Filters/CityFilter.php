<?php

namespace AllrivalSDK\Filters;

use AllrivalSDK\Filters\FilterTypes\MultipleValuesFilter;

/**
 * Город (необходимо передавать id городов)
 */
class CityFilter extends MultipleValuesFilter
{
    protected string $name = 'city';
}
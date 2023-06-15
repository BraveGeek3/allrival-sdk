<?php

namespace AllrivalSDK\Filters;

use AllrivalSDK\Filters\FilterTypes\MultipleValuesFilter;

/**
 * Компания (необходимо передавать id компаний)
 */
class CompanyFilter extends MultipleValuesFilter
{
    protected string $name = 'company';
}
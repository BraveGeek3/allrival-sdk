<?php

namespace AllrivalSDK\Filters;

use AllrivalSDK\Filters\FilterTypes\EmptyTypeMultipleValuesFilter;

/**
 * Есть совпадения с компаниями (передается id компаний)
 */
class WithMatchedCompanyFilter extends EmptyTypeMultipleValuesFilter
{
    protected string $name = 'with_matched_company';
}
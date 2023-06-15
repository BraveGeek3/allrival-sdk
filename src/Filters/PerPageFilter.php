<?php

namespace AllrivalSDK\Filters;

use AllrivalSDK\Filters\FilterTypes\OnlyExplicitValuesFilter;

/**
 * Записей на страницу
 */
class PerPageFilter extends OnlyExplicitValuesFilter
{
    protected string $name = '_per_page';
}
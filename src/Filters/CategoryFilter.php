<?php

namespace AllrivalSDK\Filters;

use AllrivalSDK\Filters\FilterTypes\MultipleValuesFilter;

/**
 * Категория (необходимо передавать id категорий)
 */
class CategoryFilter extends MultipleValuesFilter
{
    protected string $name = 'category';
}
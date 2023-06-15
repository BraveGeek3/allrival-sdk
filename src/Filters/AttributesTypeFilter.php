<?php

namespace AllrivalSDK\Filters;

use AllrivalSDK\Filters\FilterTypes\OnlyExplicitValuesFilter;

/**
 * Название одного из атрибутов
 */
class AttributesTypeFilter extends OnlyExplicitValuesFilter
{
    protected string $name = 'attributes_type';
}
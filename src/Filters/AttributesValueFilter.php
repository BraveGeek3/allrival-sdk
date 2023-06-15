<?php

namespace AllrivalSDK\Filters;

use AllrivalSDK\Filters\FilterTypes\OnlyExplicitValuesFilter;

/**
 * Значение одного из аттрибутов
 */
class AttributesValueFilter extends OnlyExplicitValuesFilter
{
    protected string $name = 'attributes_value';
}
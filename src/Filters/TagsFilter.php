<?php

namespace AllrivalSDK\Filters;

use AllrivalSDK\Filters\FilterTypes\EmptyTypeMultipleValuesFilter;

/**
 * Тэги (передаются id тэгов)
 */
class TagsFilter extends EmptyTypeMultipleValuesFilter
{
    protected string $name = 'tags';
}
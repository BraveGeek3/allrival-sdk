<?php

namespace AllrivalSDK\Filters\FilterTypes;

use AllrivalSDK\Filters\BaseFilter;

/**
 * Фильтр для строковых значений.
 * Позволяет указать принадлежит ли одна строка другой или сравнить их
 */
abstract class MembershipFilter extends BaseFilter
{
    // содержит значение
    public const CONTAINS= '1';

    // не содержит значение
    public const NOT_CONTAINS = '2';

    // равен значению
    public const EQUAL_TO = '3';
}
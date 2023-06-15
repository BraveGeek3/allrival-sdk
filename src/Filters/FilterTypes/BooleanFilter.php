<?php

namespace AllrivalSDK\Filters\FilterTypes;

use AllrivalSDK\Filters\BaseFilter;

/**
 * Фильтр для булевый типов фильтров (где есть выбор да/нет)
 * Данные фильтры не имеют типа
 */
abstract class BooleanFilter extends EmptyTypeFilter
{
    //Возможные значения фильтров представлены ниже

    // да
    public const YES = '1';

    // нет
    public const NO = '2';
}
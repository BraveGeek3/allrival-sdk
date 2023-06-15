<?php

namespace AllrivalSDK\Filters\FilterTypes;

use AllrivalSDK\Filters\BaseFilter;

/**
 * Фильтр для сравнения числовых значений
 */
abstract class InequalityFilter extends BaseFilter
{
    // > //
    public const GREATER_THAN = '2';

    // < //
    public const LESS_THAN = '5';

    // >= //
    public const GREATER_THAN_OR_EQUAL_TO = '1';

    // <= //
    public const LESS_THAN_OR_EQUAL_TO = '4';

    // = //
    public const EQUAL_TO = '3';

    // != //
    // Только для отклонения от рекомендуемой цены //
    public const NOT_EQUAL_TO = '';
}
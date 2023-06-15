<?php

namespace AllrivalSDK\Filters\FilterTypes;

use AllrivalSDK\Exceptions\InvalidArgumentException;
use AllrivalSDK\Filters\BaseFilter;

/**
 * Фильтр для типов фильтров с выбором нескольких значений (города, категории и компании) с типом фильтра
 */
class MultipleValuesFilter extends BaseFilter
{
    // равен
    public const EQUAL = '1';

    // не равен
    public const NOT_EQUAL = '2';

    public function __construct(array $values, string $type = '')
    {
        $finalValue = $this->generateQueryDependsOnValues(...$values);
        parent::__construct($finalValue, $type);
    }

    public function getStringQuery(): string
    {
        return "filter[" . $this->name . "][type]=". $this->type ."&" . $this->value;
    }

    private function generateQueryDependsOnValues(...$values): string
    {
        $strValuesArray = [];
        foreach ($values as $value) {
            $strValuesArray[] = "filter[" . $this->name ."][value][]=$value";
        }

        return implode("&", $strValuesArray);
    }
}
<?php

namespace AllrivalSDK\Filters\FilterTypes;

/**
 * Фильтр для типов фильтров с выбором нескольких значений (тэги, города, категории и т.д.) без типа фильтра
 */
abstract class EmptyTypeMultipleValuesFilter extends EmptyTypeFilter
{
    public function __construct(...$values)
    {
        $value = $this->generateQueryDependsOnValues(...$values);
        parent::__construct($value);
    }

    public function getStringQuery(): string
    {
        return $this->value;
    }

    public static function getAllowedTypeValues(): array
    {
        return [];
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
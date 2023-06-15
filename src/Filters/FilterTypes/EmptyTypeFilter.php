<?php

namespace AllrivalSDK\Filters\FilterTypes;

use AllrivalSDK\Filters\BaseFilter;

/**
 * Фильтр без указания типа, принимает только явные значения
 * Примеры параметров можно посмотреть в личном кабинете allrival.com
 */
abstract class EmptyTypeFilter extends BaseFilter
{
    public function __construct(string $value)
    {
        parent::__construct($value, '');
    }

    public function setType(string $type): void
    {
        $this->type = '';
    }

    /**
     * @return array
     */
    public static function getAllowedTypeValues(): array
    {
        return [];
    }

    public function getStringQuery(): string
    {
        return "filter[" . $this->getName() . "][value]=" . $this->value;
    }
}
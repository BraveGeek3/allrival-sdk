<?php

namespace AllrivalSDK\Filters\FilterTypes;

use AllrivalSDK\Exceptions\InvalidArgumentException;
use AllrivalSDK\Filters\BaseFilter;
use AllrivalSDK\Tools\Converter;
use DateTime;

/**
 * Фильтр для работы с датой
 */
abstract class TimePeriodFilter extends BaseFilter
{
    /**
     * Получает товары входящие в промежуток $dateFrom и $dateTo
     */
    public const BETWEEN = '1';

    /**
     * Получает товары не входящие в промежуток $dateFrom и $dateTo
     */
    public const NOT_BETWEEN = '2';

    private $dateFrom;
    private $dateTo;

    /**
     * @throws InvalidArgumentException
     */
    public function __construct($dateFrom = null, $dateTo = null, string $type = '')
    {
        $value = $this->transformDatesToFilterValue($dateFrom, $dateTo);
        parent::__construct($value, $type);
    }

    /**
     * Пробует конвертировать даты в нужный для фильтра формат
     *
     * @throws InvalidArgumentException
     */
    public function transformDatesToFilterValue($dateFrom, $dateTo): string
    {
         $strDateFrom = urlencode($dateFrom === null ? '' : Converter::convertDateToFormat($dateFrom));
         $strDateTo = urlencode($dateTo === null ? '' : Converter::convertDateToFormat($dateTo));

        return "filter[" . $this->getName() . "][value][start]=$strDateFrom&filter[" . $this->getName() . "][value][end]=$strDateTo";
    }

    /**
     * @return string
     */
    public function getStringQuery(): string
    {
        return $this->type = "filter[" . $this->getName() . "][type]=" . $this->type . '&' . $this->getValue();
    }

    /**
     * @return mixed
     */
    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    /**
     * @param mixed $dateFrom
     */
    public function setDateFrom($dateFrom): void
    {
        $this->dateFrom = $dateFrom;
    }

    /**
     * @return mixed
     */
    public function getDateTo()
    {
        return $this->dateTo;
    }

    /**
     * @param mixed $dateTo
     */
    public function setDateTo($dateTo): void
    {
        $this->dateTo = $dateTo;
    }
}
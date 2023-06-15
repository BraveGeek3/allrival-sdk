<?php

namespace AllrivalSDK\Managers;

use AllrivalSDK\ApiEndpoints;
use AllrivalSDK\Builders\BaseBuilder;
use AllrivalSDK\Builders\PriceHistoryBuilder;
use AllrivalSDK\Exceptions\InvalidArgumentException;
use AllrivalSDK\Tools\Converter;
use DateTime;

class PriceHistoryManager extends BaseManager
{
    /**
     * @param int $productId
     * @param $dateFrom
     * @param $dateTo
     * @return array
     * @throws InvalidArgumentException
     * @throws \AllrivalSDK\Exceptions\BadCredentialsException
     * @throws \AllrivalSDK\Exceptions\BadRequestException
     * @throws \AllrivalSDK\Exceptions\MethodNotAllowedException
     */
    public function getPriceHistory(int $productId, $dateFrom = null, $dateTo = null)
    {
        $dateFrom = $dateFrom ?? 0;
        $dateTo = $dateTo ?? time();
        $timestampFrom = ($dateFrom instanceof DateTime) ?
            Converter::convertDtToTimstmp($dateFrom) :
            (
            is_int($dateFrom) ? $dateFrom : strtotime($dateFrom)
            )
        ;

        $timestampTo = ($dateTo instanceof DateTime) ?
            Converter::convertDtToTimstmp($dateTo) :
            (
            is_int($dateTo) ? $dateTo : strtotime($dateFrom)
            )
        ;

        if (!is_int($timestampFrom) || !is_int($timestampTo))
        {
            throw new InvalidArgumentException("Invalid date format, try to use \"Y-m-d\" string format or DateTime");
        }

        $url = str_replace('{productId}', $productId, ApiEndpoints::PRICE_HISTORY) . "?date_from=$timestampFrom&date_to=$timestampTo";

        $jsonData = $this->httpClient->sendRequest($url);

        return $this->returnData($jsonData);
    }

    protected function getBuilder(): BaseBuilder
    {
        return new PriceHistoryBuilder();
    }
}
<?php

namespace AllrivalSDK\Managers;

use AllrivalSDK\ApiEndpoints;
use AllrivalSDK\Builders\BaseBuilder;
use AllrivalSDK\Builders\ProductBuilder;
use AllrivalSDK\Exceptions\BadCredentialsException;
use AllrivalSDK\Exceptions\BadRequestException;
use AllrivalSDK\Exceptions\InvalidArgumentException;
use AllrivalSDK\Exceptions\MethodNotAllowedException;
use AllrivalSDK\Tools\Converter;
use AllrivalSDK\Types\ProductType;
use DateTime;

class ProductManager extends BaseManager
{
    /**
     * @param string $url
     * @return ProductType|array
     * @throws BadCredentialsException
     * @throws MethodNotAllowedException
     * @throws BadRequestException
     * @throws InvalidArgumentException
     */
    public function addProduct(string $url)
    {
        $jsonData = $this->httpClient->sendRequest(ApiEndpoints::PRODUCTS, 'POST', ['url' => $url]);

        return $this->returnData($jsonData);
    }

    /**
     * @param string $url
     * @return bool
     * @throws BadCredentialsException
     * @throws MethodNotAllowedException
     * @throws \JsonException
     */
    public function deleteProduct(string $url): bool
    {
        $jsonData = $this->httpClient->sendRequest(ApiEndpoints::PRODUCTS, 'DELETE', ['url' => $url]);

        return $jsonData['isDeleted'];
    }

//    /**
//     * @param int $productId
//     * @param $dateFrom
//     * @param $dateTo
//     * @return array
//     * @throws BadCredentialsException
//     * @throws BadRequestException
//     * @throws InvalidArgumentException
//     * @throws MethodNotAllowedException
//     */
//    public function getPriceHistory(int $productId, $dateFrom = null, $dateTo = null): array
//    {
//        $dateFrom = $dateFrom ?? 0;
//        $dateTo = $dateTo ?? time();
//        $timestampFrom = ($dateFrom instanceof DateTime) ?
//            Converter::convertDtToTimstmp($dateFrom) :
//            (
//                is_int($dateFrom) ? $dateFrom : strtotime($dateFrom)
//            )
//        ;
//
//        $timestampTo = ($dateTo instanceof DateTime) ?
//            Converter::convertDtToTimstmp($dateTo) :
//            (
//                is_int($dateTo) ? $dateTo : strtotime($dateFrom)
//            )
//        ;
//
//        if (!is_int($timestampFrom) || !is_int($timestampTo))
//        {
//            throw new InvalidArgumentException("Invalid date format, try to use \"Y-m-d\" string format or DateTime");
//        }
//
//        $url = str_replace('{productId}', $productId, ApiEndpoints::PRICE_HISTORY) . "?date_from=$timestampFrom&date_to=$timestampTo";
//
//        return $this->httpClient->sendRequest($url);
//
//    }

    protected function getBuilder(): BaseBuilder
    {
        return new ProductBuilder();
    }
}
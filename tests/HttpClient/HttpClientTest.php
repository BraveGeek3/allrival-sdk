<?php

namespace AllrivalSDK\Tests\HttpClient;

use AllrivalSDK\Exceptions\BadCredentialsException;
use AllrivalSDK\Managers\PriceHistoryManager;
use PHPUnit\Framework\TestCase;

class HttpClientTest extends TestCase
{
    private PriceHistoryManager $priceHistoryManager;

    /**
     * Проверяем что с неправильным апи ключом выдаст BadCredentialsException
     *
     * @return void
     * @throws BadCredentialsException
     * @throws \AllrivalSDK\Exceptions\BadRequestException
     * @throws \AllrivalSDK\Exceptions\InvalidArgumentException
     * @throws \AllrivalSDK\Exceptions\MethodNotAllowedException
     */
    public function test_wrong_api_key_throw_exception()
    {
        $this->expectException(BadCredentialsException::class);

        $apiKey = '1234';
        $this->priceHistoryManager = new PriceHistoryManager($apiKey);
        $this->priceHistoryManager->getPriceHistory(123);
    }
}
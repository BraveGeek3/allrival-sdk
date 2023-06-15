<?php

namespace AllrivalSDK\Tests\Managers;

use AllrivalSDK\Managers\PriceHistoryManager;
use AllrivalSDK\Tests\HelperUtil;
use AllrivalSDK\Types\PriceHistoryType;
use PHPUnit\Framework\TestCase;

class PriceHistoryManagerTest extends TestCase
{
    private PriceHistoryManager $priceHistoryManager;

    protected function setUp(): void
    {
        $apiKey = HelperUtil::extractApiKey();

        $this->priceHistoryManager = new PriceHistoryManager($apiKey);
    }

    /**
     * Захардкоженно проверяем что получена правильная история цен
     *
     * @return void
     * @throws \AllrivalSDK\Exceptions\BadCredentialsException
     * @throws \AllrivalSDK\Exceptions\BadRequestException
     * @throws \AllrivalSDK\Exceptions\InvalidArgumentException
     * @throws \AllrivalSDK\Exceptions\MethodNotAllowedException
     */
    public function test_get_price_history_successfully()
    {
        $productId = 2892551660;

        /**
         * @var PriceHistoryType $priceHistory
         */
        $priceHistory = $this->priceHistoryManager->getPriceHistory($productId);
        $this->assertTrue($priceHistory instanceof PriceHistoryType);

        $history = $priceHistory->getHistory();
        $this->assertTrue(is_array($history));
        $this->assertTrue(!empty($history));

        $price = $priceHistory->getByDate(1673523358);
        $this->assertTrue(is_float($price));
        $this->assertEquals($price, 114.0);
    }
}
<?php

namespace AllrivalSDK\Tests\Filters;

use AllrivalSDK\Filters\CostPriceFilter;
use AllrivalSDK\Filters\FilterTypes\InequalityFilter;
use AllrivalSDK\Managers\ReportManager;
use AllrivalSDK\Tests\HelperUtil;
use AllrivalSDK\Types\ProductType;
use AllrivalSDK\Types\ReportType;
use PHPUnit\Framework\TestCase;

class InequalityFilterTest extends TestCase
{
    private ReportManager $reportManager;

    protected function setUp(): void
    {
        $apiKey = HelperUtil::extractApiKey();

        $this->reportManager = new ReportManager($apiKey);
    }

    /**
     * Захардкоженным значением себестоимости проверяем,
     * что Inequality фильтры работыют
     *
     * @return void
     * @throws \AllrivalSDK\Exceptions\BadCredentialsException
     * @throws \AllrivalSDK\Exceptions\BadRequestException
     * @throws \AllrivalSDK\Exceptions\InvalidArgumentException
     * @throws \AllrivalSDK\Exceptions\MethodNotAllowedException
     */
    public function test_inequality_filter_working()
    {
        $costPriceFilter = new CostPriceFilter(100, InequalityFilter::GREATER_THAN);

        /**
         * @var ReportType $result
         */
        $result = $this->reportManager->getYourProducts($costPriceFilter);

        $items = $result->getItems();
        $this->assertTrue(!empty($items) && \count($items) === 2);
        foreach ($items as $item) {
            $this->assertTrue($item instanceof ProductType);
        }
    }
}
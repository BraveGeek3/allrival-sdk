<?php

namespace AllrivalSDK\Tests\Filters;

use AllrivalSDK\Filters\FilterTypes\BooleanFilter;
use AllrivalSDK\Filters\WithMatchesFilter;
use AllrivalSDK\Managers\ReportManager;
use AllrivalSDK\Tests\HelperUtil;
use AllrivalSDK\Types\ProductType;
use AllrivalSDK\Types\ReportType;
use PHPUnit\Framework\TestCase;

class BooleanFilterTest extends TestCase
{
    private ReportManager $reportManager;

    protected function setUp(): void
    {
        $apiKey = HelperUtil::extractApiKey();

        $this->reportManager = new ReportManager($apiKey);
    }

    /**
     * Захардкоженным количеством сопоставлений проверяем,
     * что Boolean фильтр работает
     *
     * @return void
     * @throws \AllrivalSDK\Exceptions\BadCredentialsException
     * @throws \AllrivalSDK\Exceptions\BadRequestException
     * @throws \AllrivalSDK\Exceptions\InvalidArgumentException
     * @throws \AllrivalSDK\Exceptions\MethodNotAllowedException
     */
    public function test_boolean_filterts_working()
    {
        $withMatchesFilter = new WithMatchesFilter(BooleanFilter::YES);

        /**
         * @var ReportType $result
         */
        $result = $this->reportManager->getYourProducts($withMatchesFilter);

        $items = $result->getItems();
        $this->assertTrue(!empty($items) && \count($items) === 3);
        foreach ($items as $item) {
            $this->assertTrue($item instanceof ProductType);
        }
    }

}
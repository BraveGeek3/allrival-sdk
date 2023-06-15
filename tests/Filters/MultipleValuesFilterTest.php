<?php

namespace AllrivalSDK\Tests\Filters;

use AllrivalSDK\Filters\CityFilter;
use AllrivalSDK\Filters\CompanyFilter;
use AllrivalSDK\Filters\TagsFilter;
use AllrivalSDK\Managers\ReportManager;
use AllrivalSDK\Tests\HelperUtil;
use AllrivalSDK\Types\ProductType;
use AllrivalSDK\Types\ReportType;
use PHPUnit\Framework\TestCase;

class MultipleValuesFilterTest extends TestCase
{
    private ReportManager $reportManager;

    protected function setUp(): void
    {
        $apiKey = HelperUtil::extractApiKey();

        $this->reportManager = new ReportManager($apiKey);
    }

    /**
     * Захардкоженными значениями тегов проверяем,
     * что MultipleValues фильтр работает
     *
     * @return void
     * @throws \AllrivalSDK\Exceptions\BadCredentialsException
     * @throws \AllrivalSDK\Exceptions\BadRequestException
     * @throws \AllrivalSDK\Exceptions\InvalidArgumentException
     * @throws \AllrivalSDK\Exceptions\MethodNotAllowedException
     */
    public function test_multiple_values_filterts_working()
    {
        $city = 422;
        $cityFilter = new CityFilter([$city], CityFilter::NOT_EQUAL);

        /**
         * @var ReportType $result
         */
        $result = $this->reportManager->getYourProducts($cityFilter);

        $items = $result->getItems();
        $this->assertTrue(!empty($items) && \count($items) === 1);
        foreach ($items as $item) {
            $this->assertTrue($item instanceof ProductType);
        }
    }

    /**
     * Захардкоженным значением id компании-конкурента проверяем,
     * что фильтр 'company' (есть только у товаров-конкурентов) работает
     *
     * @return void
     * @throws \AllrivalSDK\Exceptions\BadCredentialsException
     * @throws \AllrivalSDK\Exceptions\BadRequestException
     * @throws \AllrivalSDK\Exceptions\InvalidArgumentException
     * @throws \AllrivalSDK\Exceptions\MethodNotAllowedException
     */
    public function test_multiple_values_filters_working_with_rivals()
    {
        $companyId = 52717;
        $companyFilter = new CompanyFilter([$companyId], CompanyFilter::EQUAL);

        /**
         * @var ReportType $result
         */
        $result = $this->reportManager->getRivalProducts($companyFilter);

        $items = $result->getItems();
        $this->assertTrue(!empty($items) && \count($items) === 6);
        foreach ($items as $item) {
            $this->assertTrue($item instanceof ProductType);
        }
    }
}
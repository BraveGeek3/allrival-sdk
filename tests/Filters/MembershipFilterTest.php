<?php

namespace AllrivalSDK\Tests\Filters;

use AllrivalSDK\Filters\FilterTypes\MembershipFilter;
use AllrivalSDK\Filters\NameFilter;
use AllrivalSDK\Managers\ReportManager;
use AllrivalSDK\Tests\HelperUtil;
use AllrivalSDK\Types\ProductType;
use AllrivalSDK\Types\ReportType;
use PHPUnit\Framework\TestCase;

class MembershipFilterTest extends TestCase
{
    private ReportManager $reportManager;

    protected function setUp(): void
    {
        $apiKey = HelperUtil::extractApiKey();

        $this->reportManager = new ReportManager($apiKey);
    }

    /**
     * Захардкоженным названием проверяем,
     * что Membership фильтр работает
     *
     * @return void
     * @throws \AllrivalSDK\Exceptions\BadCredentialsException
     * @throws \AllrivalSDK\Exceptions\BadRequestException
     * @throws \AllrivalSDK\Exceptions\InvalidArgumentException
     * @throws \AllrivalSDK\Exceptions\MethodNotAllowedException
     */
    public function test_membership_filter_working()
    {
        $nameFilter = new NameFilter("Прямая однофазная вилка", MembershipFilter::CONTAINS);

        /**
         * @var ReportType $result
         */
        $result = $this->reportManager->getYourProducts($nameFilter);

        $items = $result->getItems();
        $this->assertTrue(!empty($items) && \count($items) === 1);
        foreach ($items as $item) {
            $this->assertTrue($item instanceof ProductType);
        }
    }
}
<?php

namespace AllrivalSDK\Tests\Filters;

use AllrivalSDK\Filters\TagsFilter;
use AllrivalSDK\Managers\ReportManager;
use AllrivalSDK\Tests\HelperUtil;
use AllrivalSDK\Types\ProductType;
use AllrivalSDK\Types\ReportType;
use PHPUnit\Framework\TestCase;

class EmptyTypeMultipleValuesFilterTest extends TestCase
{
    private ReportManager $reportManager;

    protected function setUp(): void
    {
        $apiKey = HelperUtil::extractApiKey();

        $this->reportManager = new ReportManager($apiKey);
    }

    /**
     * Захардкоженными значениями тегов проверяем,
     * что EmptyTypeMultipleValues фильтр работает
     *
     * @return void
     * @throws \AllrivalSDK\Exceptions\BadCredentialsException
     * @throws \AllrivalSDK\Exceptions\BadRequestException
     * @throws \AllrivalSDK\Exceptions\InvalidArgumentException
     * @throws \AllrivalSDK\Exceptions\MethodNotAllowedException
     */
    public function test_empty_type_multiple_values_filterts_working()
    {
        $tags = [369,370,371];
        $tagsFilter = new TagsFilter(...$tags);

        /**
         * @var ReportType $result
         */
        $result = $this->reportManager->getYourProducts($tagsFilter);

        $items = $result->getItems();
        $this->assertTrue(!empty($items) && \count($items) === 3);
        foreach ($items as $item) {
            $this->assertTrue($item instanceof ProductType);
        }
    }
}
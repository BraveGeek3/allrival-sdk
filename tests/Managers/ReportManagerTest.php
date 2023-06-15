<?php

namespace AllrivalSDK\Tests\Managers;

use AllrivalSDK\Filters\FilterTypes\InequalityFilter;
use AllrivalSDK\Filters\PriceFilter;
use AllrivalSDK\Managers\ReportManager;
use AllrivalSDK\Tests\HelperUtil;
use AllrivalSDK\Types\Pagination\Pagination;
use AllrivalSDK\Types\ProductType;
use PHPUnit\Framework\TestCase;

class ReportManagerTest extends TestCase
{
    private ReportManager $reportManager;

    protected function setUp(): void
    {
        $apiKey = HelperUtil::extractApiKey();

        $this->reportManager = new ReportManager($apiKey);
    }

    //////////////////////////////////
    // Ваши продукты / Your Products//
    //////////////////////////////////
    public function test_successfully_get_your_products_without_filters()
    {
        $result = $this->reportManager->getYourProducts();

        $this->assertTrue(is_array($result->getItems()));
        foreach ($result->getItems() as $item) {
            $this->assertTrue($item instanceof ProductType);
        }

        $this->assertTrue($result->getPagination() instanceof Pagination);
        $this->assertTrue($result->getPagination()->getPage() === 1);
    }

    public function test_successfully_get_your_products_with_filters()
    {
        $priceFilter = new PriceFilter(1, InequalityFilter::GREATER_THAN_OR_EQUAL_TO);
        $result = $this->reportManager->getYourProducts($priceFilter);

        $this->assertTrue(is_array($result->getItems()));
        foreach ($result->getItems() as $item) {
            $this->assertTrue($item instanceof ProductType);
            $this->assertTrue($item->getPrice() >= 1);
        }

        $this->assertTrue($result->getPagination() instanceof Pagination);
        $this->assertTrue($result->getPagination()->getPage() === 1);
    }

    /////////////////////////////////////////
    // Продукты конкурента / Rival products//
    /////////////////////////////////////////
    public function test_successfully_get_rival_products_without_filters()
    {
        $result = $this->reportManager->getRivalProducts();

        $this->assertTrue(is_array($result->getItems()));
        foreach ($result->getItems() as $item) {
            $this->assertTrue($item instanceof ProductType);
        }

        $this->assertTrue($result->getPagination() instanceof Pagination);
        $this->assertTrue($result->getPagination()->getPage() === 1);
    }

    public function test_successfully_get_rival_products_with_filters()
    {
        $priceFilter = new PriceFilter(1, InequalityFilter::GREATER_THAN_OR_EQUAL_TO);
        $result = $this->reportManager->getRivalProducts($priceFilter);

        $this->assertTrue(is_array($result->getItems()));
        foreach ($result->getItems() as $item) {
            $this->assertTrue($item instanceof ProductType);
            $this->assertTrue($item->getPrice() >= 1);
        }

        $this->assertTrue($result->getPagination() instanceof Pagination);
        $this->assertTrue($result->getPagination()->getPage() == 1);
    }

    //////////////////////////////
    // Сопоставления / Matching //
    //////////////////////////////
    public function test_successfully_get_similars_without_filters()
    {
        $result = $this->reportManager->getSimilars();

        $this->assertTrue(is_array($result->getItems()));
        foreach ($result->getItems() as $item) {
            $this->assertTrue($item instanceof ProductType);
        }

        $this->assertTrue($result->getPagination() instanceof Pagination);
        $this->assertTrue($result->getPagination()->getPage() === 1);
    }

    public function test_successfully_get_similars_with_filters()
    {
        $priceFilter = new PriceFilter(1, InequalityFilter::GREATER_THAN_OR_EQUAL_TO);
        $result = $this->reportManager->getSimilars($priceFilter);

        $this->assertTrue(is_array($result->getItems()));
        foreach ($result->getItems() as $item) {
            $this->assertTrue($item instanceof ProductType);
            $this->assertTrue($item->getPrice() >= 1);
        }

        $this->assertTrue($result->getPagination() instanceof Pagination);
        $this->assertTrue($result->getPagination()->getPage() === 1);
    }

    public function test_successfully_returning_array_instead_report_type()
    {
        $result = $this->reportManager->setIsReturnArray(true)->getYourProducts();
        $this->assertTrue(is_array($result));
        $this->assertTrue(isset($result['items']) && is_array($result['items']));
        foreach ($result['items'] as $item) {
            $this->assertTrue(is_array($item));
        }
    }
}
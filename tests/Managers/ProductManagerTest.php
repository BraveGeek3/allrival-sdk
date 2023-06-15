<?php

namespace AllrivalSDK\Tests\Managers;

use AllrivalSDK\Exceptions\InvalidArgumentException;
use AllrivalSDK\Managers\ProductManager;
use AllrivalSDK\Tests\HelperUtil;
use AllrivalSDK\Types\ProductType;
use PHPUnit\Framework\TestCase;

class ProductManagerTest extends TestCase
{
    private ProductManager $productManager;

    protected function setUp(): void
    {
        $apiKey = HelperUtil::extractApiKey();

        $this->productManager = new ProductManager($apiKey);
    }

    /**
     * Проверяем что можно добавить и удалить продукт
     *
     * @return void
     * @throws InvalidArgumentException
     * @throws \AllrivalSDK\Exceptions\BadCredentialsException
     * @throws \AllrivalSDK\Exceptions\BadRequestException
     * @throws \AllrivalSDK\Exceptions\MethodNotAllowedException
     * @throws \JsonException
     */
    public function test_add_and_delete_products_successfully()
    {
        $productUrl = HelperUtil::getRandomProductUrl();

        $createdProduct = $this->productManager->addProduct($productUrl);

        $this->assertTrue($createdProduct instanceof ProductType);
        $this->assertTrue($createdProduct->getUrl() === $productUrl);

        $result = $this->productManager->deleteProduct($productUrl);

        $this->assertTrue($result);
        $this->assertTrue(!is_array($result));
        $this->assertTrue(is_bool($result));
    }
}
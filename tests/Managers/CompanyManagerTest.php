<?php

namespace AllrivalSDK\Tests\Managers;

use AllrivalSDK\Exceptions\BadRequestException;
use AllrivalSDK\Managers\CompanyManager;
use AllrivalSDK\Tests\HelperUtil;
use AllrivalSDK\Types\CompanyType;
use PHPUnit\Framework\TestCase;

class CompanyManagerTest extends TestCase
{
    private CompanyManager $companyManager;

    protected function setUp(): void
    {
        $apiKey = HelperUtil::extractApiKey();

        $this->companyManager = new CompanyManager($apiKey);
    }

    /**
     * Проверяем что информация о компании получена успешно
     *
     * @return void
     * @throws \AllrivalSDK\Exceptions\BadCredentialsException
     * @throws \AllrivalSDK\Exceptions\MethodNotAllowedException
     * @throws \JsonException
     */
    public function test_get_your_company_info_successfull()
    {
        $result = $this->companyManager->getYourCompanyInfo();
        $this->assertTrue($result instanceof CompanyType);
    }

    /**
     * Проверяем что возвращается CompanyType у основной компании и у её конкурентов
     *
     * @return void
     * @throws \AllrivalSDK\Exceptions\BadCredentialsException
     * @throws \AllrivalSDK\Exceptions\MethodNotAllowedException
     * @throws \JsonException
     */
    public function test_rivals_has_company_type()
    {
        $result = $this->companyManager->getYourCompanyInfo();
        $this->assertTrue($result instanceof CompanyType);

        $rivals = $result->getRivals();
        foreach ($rivals as $rival) {
            $this->assertTrue($rival instanceof CompanyType);
        }
    }

    /**
     * Проверяем что удаление продуктов компании сработало успешно
     *
     * @return void
     * @throws \AllrivalSDK\Exceptions\BadCredentialsException
     * @throws \AllrivalSDK\Exceptions\MethodNotAllowedException
     * @throws \JsonException
     */
    public function test_products_successfully_removed()
    {
        $id = 54955;

        $this->assertTrue($this->companyManager->removeProductsByCompanyId($id));
    }

    /**
     * Проверяем что нельзя удалить компанию с чужим ID
     *
     * @return void
     * @throws \AllrivalSDK\Exceptions\BadCredentialsException
     * @throws \AllrivalSDK\Exceptions\MethodNotAllowedException
     * @throws \JsonException
     */
    public function test_cant_remove_products_with_wrong_id()
    {
        $this->expectException(BadRequestException::class);
        $id = 1234;
        $this->companyManager->removeProductsByCompanyId($id);
    }

}
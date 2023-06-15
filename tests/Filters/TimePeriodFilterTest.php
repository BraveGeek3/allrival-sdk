<?php

namespace AllrivalSDK\Tests\Filters;

use AllrivalSDK\Exceptions\InvalidArgumentException;
use AllrivalSDK\Filters\CreatedAtFilter;
use AllrivalSDK\Filters\FilterTypes\TimePeriodFilter;
use AllrivalSDK\Managers\ReportManager;
use AllrivalSDK\Tests\HelperUtil;
use AllrivalSDK\Tools\Converter;
use AllrivalSDK\Types\ReportType;
use PHPUnit\Framework\TestCase;

class TimePeriodFilterTest extends TestCase
{
    /**
     * @var int
     */
    private $dateStart;

    /**
     * @var int
     */
    private $dateEnd;

    /**
     * Выбираем случайное время в промежутке между Feb 08 2020 и Feb 08 2023
     * Время в которое проводился тест товаров
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->dateStart = rand(1581121356, 1675815792);
        $this->dateEnd = rand($this->dateStart, 1675815799);
    }

    /**
     * Создаем из Unix времени DateTime без типа и проверяем,
     * что в фильтре пустой тип и сгенерированный запрос в фильтре совпадает с тем,
     * который мы хотим получить (метод getTrueQuery)
     *
     * @return void
     * @throws InvalidArgumentException
     */
    public function test_successfully_created_from_datetime_empty_type(): void
    {
        $dtStart = Converter::convertTimstmpToDt($this->dateStart);
        $dtEnd = Converter::convertTimstmpToDt($this->dateEnd);

        $filter = new CreatedAtFilter($dtStart, $dtEnd);
        $this->assertEquals('', $filter->getType());

        $testValue = $this->getTrueQuery($dtStart, $dtEnd, $filter);
        $this->assertEquals($testValue, $filter->getValue());
    }

    /**
     * Создаем из Unix времени DateTime с типом TimePeriodFilter::BETWEEN (промежуток между dateStart и dateEnd)
     * и проверяем, что в фильтре тип '1' и сгенерированный запрос в фильтре совпадает с тем,
     * который мы хотим получить (метод getTrueQuery)
     *
     * @return void
     * @throws InvalidArgumentException
     */
    public function test_successfully_created_from_datetime_with_type()
    {
        $dtStart = Converter::convertTimstmpToDt($this->dateStart);
        $dtEnd = Converter::convertTimstmpToDt($this->dateEnd);

        $filter = new CreatedAtFilter($dtStart, $dtEnd, TimePeriodFilter::BETWEEN);

        $this->assertEquals('1', $filter->getType());

        $testValue = $this->getTrueQuery($dtStart, $dtEnd, $filter);
        $this->assertEquals($testValue, $filter->getValue());
    }

    /**
     * Захардкоженная проверка что временной фильтр работает
     * (получаем первый созданный продукт на аккаунте)
     *
     * @return void
     * @throws InvalidArgumentException
     * @throws \AllrivalSDK\Exceptions\BadCredentialsException
     * @throws \AllrivalSDK\Exceptions\BadRequestException
     * @throws \AllrivalSDK\Exceptions\MethodNotAllowedException
     */
    public function test_time_period_filters_working()
    {
        $apiKey = HelperUtil::extractApiKey();
        $createdAtFilter = new CreatedAtFilter(null, 1670958888);

        /**
         * @var ReportType $result
         */
        $result = (new ReportManager($apiKey))->getYourProducts($createdAtFilter);

        $this->assertTrue(!empty($result->getItems()));
        $this->assertTrue(\count($result->getItems()) === 1);
    }

    public function test_time_period_filters_with_type_working()
    {
        $apiKey = HelperUtil::extractApiKey();
        $createdAtFilter = new CreatedAtFilter(null, 1670958888, TimePeriodFilter::BETWEEN);

        /**
         * @var ReportType $result
         */
        $result = (new ReportManager($apiKey))->getYourProducts($createdAtFilter);
        $this->assertTrue(!empty($result->getItems()));
        $this->assertTrue(\count($result->getItems()) === 1);
    }

    /**
     * Вспомогательный метод для проверки правильной генерации GET запроса
     *
     * @param $dateStart
     * @param $dateEnd
     * @param CreatedAtFilter $filter
     * @return string
     * @throws InvalidArgumentException
     */
    private function getTrueQuery($dateStart, $dateEnd, CreatedAtFilter $filter): string
    {
        $dateStart = urlencode(Converter::convertDateToFormat($dateStart));
        $dateEnd = urlencode(Converter::convertDateToFormat($dateEnd));

        return "filter[" . $filter->getName() . "][value][start]=$dateStart&filter[" . $filter->getName() . "][value][end]=$dateEnd";
    }

}
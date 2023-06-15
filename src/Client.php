<?php

namespace AllrivalSDK;

use AllrivalSDK\Filters\FilterInterface;
use AllrivalSDK\Managers\ClusterManager;
use AllrivalSDK\Managers\CompanyManager;
use AllrivalSDK\Managers\PriceHistoryManager;
use AllrivalSDK\Managers\ProductManager;
use AllrivalSDK\Managers\ReportManager;

class Client implements ClientInterface
{
    /**
     * @var CompanyManager
     */
    private CompanyManager $companyManager;

    /**
     * @var ProductManager
     */
    private ProductManager $productManager;

    /**
     * @var ClusterManager
     */
    private ClusterManager $clusterManager;

    /**
     * @var ReportManager
     */
    private ReportManager $reportManager;

    /**
     * @var PriceHistoryManager
     */
    private PriceHistoryManager $priceHistoryManager;

    /**
     * @var string
     */
    private string $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Получает выгрузку с вашими товарами, аналогичную той,
     * что представлена в личном кабинете.
     * Возвращает тип ReportType, содержащий список ваших товаров,
     * а также информацию о пагинации (тип PaginationType с информацией о количестве страниц, количестве товаров и т.д.)
     *
     * @param ...$filters
     * @return mixed
     * @throws Exceptions\BadCredentialsException
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\InvalidArgumentException
     * @throws Exceptions\MethodNotAllowedException
     */
    public function getYourProducts(...$filters): mixed
    {
        if (!isset($this->reportManager)) {
            $this->reportManager = new ReportManager($this->apiKey);
        }

        return $this->reportManager->getYourProducts(...$filters);
    }

    /**
     * Получает выгрузку с товарами конкурентов, аналогичную той,
     * что представлена в личном кабинете.
     * Возвращает тип ReportType, содержащий список товаров конкурентов,
     * а также информацию о пагинации (тип PaginationType с информацией о количестве страниц, количестве товаров и т.д.)
     *
     * @param ...$filters
     * @return mixed
     * @throws Exceptions\BadCredentialsException
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\InvalidArgumentException
     * @throws Exceptions\MethodNotAllowedException
     */
    public function getRivalProducts(...$filters): mixed
    {
        if (!isset($this->reportManager)) {
            $this->reportManager = new ReportManager($this->apiKey);
        }

        return $this->reportManager->getRivalProducts(...$filters);
    }

    /**
     * Получает выгрузку с вашими товарами и списком сопоставлений, аналогичную той,
     * что представлена в личном кабинете.
     * Возвращает тип ReportType, содержащий список ваших товаров и массив совпавших товаров конкурентов,
     * а также информацию о пагинации (тип PaginationType с информацией о количестве страниц, количестве товаров и т.д.)
     *
     * @param ...$filters
     * @return mixed
     * @throws Exceptions\BadCredentialsException
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\InvalidArgumentException
     * @throws Exceptions\MethodNotAllowedException
     */
    public function getSimilars(...$filters): mixed
    {
        if (!isset($this->reportManager)) {
            $this->reportManager = new ReportManager($this->apiKey);
        }

        return $this->reportManager->getSimilars(...$filters);
    }

    /**
     * Перезаписывает все ранее добавленные фильтры на новые
     *
     * @param FilterInterface ...$filters
     * @return void
     * @throws Exceptions\InvalidArgumentException
     */
    public function setFilters(FilterInterface ...$filters): void
    {
        if (!isset($this->reportManager)) {
            $this->reportManager = new ReportManager($this->apiKey);
        }

        $this->reportManager->setFilters(...$filters);
    }

    /**
     * Добавляет фильтр в массив со всеми фильтрами.
     * Если фильтр с таким названием уже существует, то кидает исключение
     *
     * @param FilterInterface $filter
     * @return void
     * @throws Exceptions\InvalidArgumentException
     */
    public function addFilter(FilterInterface $filter): void
    {
        if (!isset($this->reportManager)) {
            $this->reportManager = new ReportManager($this->apiKey);
        }

        $this->reportManager->addFilter($filter);
    }

    /**
     * Удаляет фильтр по его имени.
     * Принимает объект фильтра или строку с его названием
     *
     * @param $filter
     * @return void
     * @throws Exceptions\InvalidArgumentException
     */
    public function removeFilter($filter): void
    {
        if (!isset($this->reportManager)) {
            $this->reportManager = new ReportManager($this->apiKey);
        }

        $this->reportManager->removeFilter($filter);
    }

    /**
     * Заменяет фильтр из массива на переданный.
     * Если фильтра нет, то добавляет его в массив фильтров
     *
     * @param FilterInterface $filter
     * @return void
     * @throws Exceptions\InvalidArgumentException
     */
    public function replaceFilter(FilterInterface $filter): void
    {
        if (!isset($this->reportManager)) {
            $this->reportManager = new ReportManager($this->apiKey);
        }

        $this->reportManager->replaceFilter($filter);
    }

    /**
     * Удаляет все элементы массива фильтров
     *
     * @return void
     */
    public function resetFilters(): void
    {
        if (!isset($this->reportManager)) {
            $this->reportManager = new ReportManager($this->apiKey);
        }

        $this->reportManager->resetFilters();
    }

    /**
     * Устанавливает в пагинации стандартные значения:
     * страница - 1, количество товаров на странице - 100
     *
     * @return void
     */
    public function resetPagination(): void
    {
        if (!isset($this->reportManager)) {
            $this->reportManager = new ReportManager($this->apiKey);
        }

        $this->reportManager->resetPagination();
    }

    /**
     * Устанавливает количество товаров на странице в пагинации
     *
     * @param int $perPage
     * @return void
     */
    public function setPerPage(int $perPage): void
    {
        if (!isset($this->reportManager)) {
            $this->reportManager = new ReportManager($this->apiKey);
        }

        $this->reportManager->setPerPage($perPage);
    }

    /**
     * Устанавливает страницу в пагинации
     *
     * @param int $page
     * @return void
     */
    public function setPage(int $page): void
    {
        if (!isset($this->reportManager)) {
            $this->reportManager = new ReportManager($this->apiKey);
        }

        $this->reportManager->setPage($page);
    }

    /**
     * Создает сопоставление товаров по их id.
     * Возвращает тип ClusterType с информацией о сопоставлении
     *
     * @param int $yourProductId
     * @param int $rivalProductId
     * @return mixed
     */
    public function createMatching(int $yourProductId, int $rivalProductId)
    {
        if (!isset($this->clusterManager)) {
            $this->clusterManager = new ClusterManager($this->apiKey);
        }

        return $this->clusterManager->createMatching($yourProductId, $rivalProductId);
    }

    /**
     * Удаляет сопоставление товаров по их id.
     * Возвращает тип ClusterType с информацией о сопоставлении
     *
     * @param int $yourProductId
     * @param int $rivalProductId
     * @return mixed
     */
    public function deleteMatching(int $yourProductId, int $rivalProductId): mixed
    {
        if (!isset($this->clusterManager)) {
            $this->clusterManager = new ClusterManager($this->apiKey);
        }

        return $this->clusterManager->deleteMatching($yourProductId, $rivalProductId);
    }

    /**
     * Получает информацию о компании и её конкурентах.
     * Возвращает тип CompanyType с информацией о компании
     *
     * @return mixed
     * @throws Exceptions\BadCredentialsException
     * @throws Exceptions\MethodNotAllowedException
     * @throws \JsonException
     */
    public function getYourCompanyInfo(): mixed
    {
        if (!isset($this->companyManager)) {
            $this->companyManager = new CompanyManager($this->apiKey);
        }

        return $this->companyManager->getYourCompanyInfo();
    }

    /**
     * Удаляет компанию вместе с продуктами.
     * Возвращает булево значение об успешности удаления
     *
     * @param $companyId
     * @return bool
     * @throws Exceptions\BadCredentialsException
     * @throws Exceptions\MethodNotAllowedException
     * @throws \JsonException
     */
    public function removeProductsByCompanyId($companyId): bool
    {
        if (!isset($this->companyManager)) {
            $this->companyManager = new CompanyManager($this->apiKey);
        }

        return $this->companyManager->removeProductsByCompanyId($companyId);
    }

    /**
     * Создает товар по его URL.
     * Возвращает тип ProductType с информацией о товаре
     *
     * @param string $url
     * @return mixed
     * @throws Exceptions\BadCredentialsException
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\InvalidArgumentException
     * @throws Exceptions\MethodNotAllowedException
     */
    public function addProduct(string $url): mixed
    {
        if (!isset($this->productManager)) {
            $this->productManager = new ProductManager($this->apiKey);
        }

        return $this->productManager->addProduct($url);
    }

    /**
     * Удаляет товар по его URL.
     * Возвращает булево значение об успешности удаления
     *
     * @param string $url
     * @return bool
     * @throws Exceptions\BadCredentialsException
     * @throws Exceptions\MethodNotAllowedException
     * @throws \JsonException
     */
    public function deleteProduct(string $url): bool
    {
        if (!isset($this->productManager)) {
            $this->productManager = new ProductManager($this->apiKey);
        }

        return $this->productManager->deleteProduct($url);
    }

    /**
     * Позволяет получить историю цен товара по его ID.
     * Возвращает объект класса PriceHistoryType
     *
     * @param int $productId
     * @param $dateFrom
     * @param $dateTo
     * @return mixed
     * @throws Exceptions\BadCredentialsException
     * @throws Exceptions\BadRequestException
     * @throws Exceptions\InvalidArgumentException
     * @throws Exceptions\MethodNotAllowedException
     */
    public function getPriceHistory(int $productId, $dateFrom = null, $dateTo = null): mixed
    {
        if (!isset($this->priceHistoryManager)) {
            $this->priceHistoryManager = new PriceHistoryManager($this->apiKey);
        }

        return $this->priceHistoryManager->getPriceHistory($productId, $dateFrom, $dateTo);
    }
}
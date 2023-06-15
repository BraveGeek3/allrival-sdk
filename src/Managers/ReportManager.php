<?php

namespace AllrivalSDK\Managers;

use AllrivalSDK\ApiEndpoints;
use AllrivalSDK\Builders\BaseBuilder;
use AllrivalSDK\Builders\ReportBuilder;
use AllrivalSDK\Exceptions\BadCredentialsException;
use AllrivalSDK\Exceptions\BadRequestException;
use AllrivalSDK\Exceptions\InvalidArgumentException;
use AllrivalSDK\Exceptions\MethodNotAllowedException;
use AllrivalSDK\Filters\FilterInterface;
use AllrivalSDK\Types\Pagination\Pagination;
use AllrivalSDK\Validators\FilterValidator;

//TODO: сделать что-нибудь с пагинацией
class ReportManager extends BaseManager
{
    private Pagination $pagination;
    private array $filters = [];

    /**
     * @param string $apiKey
     * @param bool $isReturnJson
     */
    public function __construct(string $apiKey, bool $isReturnJson = false)
    {
        $this->pagination = new Pagination();

        parent::__construct($apiKey, $isReturnJson);
    }


    /**
     * @param FilterInterface ...$filters
     * @return mixed
     * @throws BadCredentialsException
     * @throws BadRequestException
     * @throws InvalidArgumentException
     * @throws MethodNotAllowedException
     */
    public function getYourProducts(FilterInterface ...$filters)
    {
        FilterValidator::validateFilters($filters);

        $query = $this->buildQuery($filters);
        $jsonData = $this->httpClient->sendRequest(ApiEndpoints::YOUR_PRODUCTS . $query);

        return $this->returnData($jsonData);
    }

    /**
     * @param FilterInterface ...$filters
     * @return mixed
     * @throws BadCredentialsException
     * @throws BadRequestException
     * @throws InvalidArgumentException
     * @throws MethodNotAllowedException
     */
    public function getRivalProducts(FilterInterface ...$filters)
    {
        FilterValidator::validateFilters($filters);

        $query = $this->buildQuery($filters);
        $jsonData = $this->httpClient->sendRequest(ApiEndpoints::RIVAL_PRODUCTS . $query);

        return $this->returnData($jsonData);

    }

    /**
     * @param FilterInterface ...$filters
     * @return mixed
     * @throws BadCredentialsException
     * @throws BadRequestException
     * @throws InvalidArgumentException
     * @throws MethodNotAllowedException
     */
    public function getSimilars(FilterInterface ...$filters)
    {
        FilterValidator::validateFilters($filters);

        $query = $this->buildQuery($filters);
        $jsonData = $this->httpClient->sendRequest(ApiEndpoints::SIMILAR_PRODUCTS . $query);

        return $this->returnData($jsonData);
    }

    /**
     * @param FilterInterface ...$filters
     * @return void
     * @throws InvalidArgumentException
     */
    public function setFilters(FilterInterface ...$filters): void {
        FilterValidator::validateFilters($filters);

        $this->filters = [];
        foreach ($filters as $filter) {
            //TODO: подумать правильно это или нет
//            if (isset($this->filters[$filter->getName()]))
//                throw new InvalidArgumentException("Filter with name " . $filter->getName() . " already in use");

            $this->filters[$filter->getName()] = $filter;
        }
    }

    /**
     * @param FilterInterface $filter
     * @return void
     * @throws InvalidArgumentException
     */
    public function addFilter(FilterInterface $filter): void
    {
        FilterValidator::validateFilters([$filter]);

        if (isset($this->filters[$filter->getName()]))
            throw new InvalidArgumentException("Filter with name " . $filter->getName() . " already in use");

        $this->filters[$filter->getName()] = $filter;
    }

    /**
     * @param FilterInterface|string $filter
     * @return void
     * @throws InvalidArgumentException
     */
    public function removeFilter($filter): void
    {
        $name = '';

        if (is_string($filter))
            $name = $filter;

        if ($filter instanceof FilterInterface)
            $name = $filter->getName();

        if ($name === '')
            throw new InvalidArgumentException("Invalid type for \$filter, expected string or FilterInterface");

        if (!isset($this->filters[$name]))
            return;

        unset($this->filters[$filter->getName()]);
    }

    /**
     * @param FilterInterface $filter
     * @return void
     * @throws InvalidArgumentException
     */
    public function replaceFilter(FilterInterface $filter): void
    {
        FilterValidator::validateFilters([$filter]);

        $this->filters[$filter->getName()] = $filter;
    }

    /**
     * @return void
     */
    public function resetFilters(): void
    {
        $this->filters = [];
    }

    /**
     * @return void
     */
    public function resetPagination(): void
    {
        $this->pagination->reset();
    }

    /**
     * @param int $perPage
     * @return void
     */
    public function setPerPage(int $perPage): void
    {
        $this->pagination->setPerPage($perPage);
    }

    /**
     * @param int $page
     * @return void
     */
    public function setPage(int $page): void
    {
        $this->pagination->setPage($page);
    }
    
    /**
     * @return BaseBuilder
     */
    protected function getBuilder(): BaseBuilder
    {
        return new ReportBuilder();
    }

    /**
     * @param array<FilterInterface> $filters
     * @return string
     */
    private function buildQuery(array $filters): string
    {
        $selectedFilters = empty($filters) ? $this->filters : $filters;

        $separateQueries = [];
        foreach ($selectedFilters as $filter) {
            $separateQueries[] = $filter->getStringQuery();
        }

        $separateQueries[] = "filter[_page]=" . $this->pagination->getPage() . "&filter[_per_page]=" . $this->pagination->getPerPage();

        return "?" .  implode("&", $separateQueries);
    }
}
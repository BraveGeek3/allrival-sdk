<?php

namespace AllrivalSDK\Builders;

use AllrivalSDK\Types\Pagination\Pagination;
use AllrivalSDK\Types\ReportType;

class ReportBuilder extends BaseBuilder
{
    private ReportType $report;

    public function build(array $data): ReportType
    {
        $this->report
            ->setItems($this->buildProducts($data['items']))
            ->setPagination($this->buildPagination($data));

        $result = $this->report;
        $this->reset();

        return $result;
    }

    protected function reset(): void
    {
        $this->report = new ReportType();
    }

    /**
     * @param array $items
     * @return array
     */
    private function buildProducts(array $items): array
    {
        $productBuilder = new ProductBuilder();
        $products = [];
        foreach ($items as $item) {
            $products[] = $productBuilder->build($item);
        }

        return $products;
    }

    /**
     * @param array $data
     * @return Pagination
     */
    private function buildPagination(array $data): Pagination
    {
        $paginationBuilder = new PaginationBuilder();

        return $paginationBuilder->build($data);
    }
}
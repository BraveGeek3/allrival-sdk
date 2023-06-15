<?php

namespace AllrivalSDK\Builders;

use AllrivalSDK\Types\Pagination\Pagination;
use AllrivalSDK\Types\TypeInterface;

class PaginationBuilder extends BaseBuilder
{
    /**
     * @var Pagination
     */
    private Pagination $pagination;

    /**
     * @param array $data
     * @return Pagination
     */
    public function build(array $data): Pagination
    {
        $this->pagination
            ->setPage($data['page'])
            ->setPagesCount($data['pages_count'])
            ->setPerPage($data['per_page'])
            ->setItemsCount($data['items_count'])
            ->setItemsTotalCount($data['items_total_count'])
        ;

        $result = $this->pagination;
        $this->reset();

        return $result;
    }

    /**
     * @return void
     */
    protected function reset(): void
    {
        $this->pagination = new Pagination();
    }
}
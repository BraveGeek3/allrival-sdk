<?php

namespace AllrivalSDK\Types;

use AllrivalSDK\Types\Pagination\Pagination;

class ReportType implements TypeInterface
{
    private Pagination $pagination;
    private array $items;


//    /**
//     * @return int
//     */
//    public function getPage(): int
//    {
//        return $this->pagination->getPage();
//    }
//
//    /**
//     * @param int $page
//     */
//    public function setPage(int $page): self
//    {
//        $this->pagination->setPage($page);
//
//        return $this;
//    }
//
//    /**
//     * @return int
//     */
//    public function getPagesCount(): int
//    {
//        return $this->pagination->getPagesCount();
//    }

//    /**
//     * @param int $pagesCount
//     */
//    public function setPagesCount(int $pagesCount): self
//    {
//        $this->pagesCount = $pagesCount;
//
//        return $this;
//    }

//    /**
//     * @return int
//     */
//    public function getPerPage(): int
//    {
//        return $this->pagination->getPerPage();
//    }
//
//    /**
//     * @param int $perPage
//     * @return $this
//     */
//    public function setPerPage(int $perPage): self
//    {
//        $this->perPage = $perPage;
//
//        return $this;
//    }
//
//    /**
//     * @return int
//     */
//    public function getItemsCount(): int
//    {
//        return $this->itemsCount;
//    }
//
//    /**
//     * @param int $itemsCount
//     */
//    public function setItemsCount(int $itemsCount): self
//    {
//        $this->itemsCount = $itemsCount;
//
//        return $this;
//    }
//
//    /**
//     * @return int
//     */
//    public function getItemsTotalCount(): int
//    {
//        return $this->itemsTotalCount;
//    }
//
//    /**
//     * @param int $itemsTotalCount
//     * @return ReportType
//     */
//    public function setItemsTotalCount(int $itemsTotalCount): self
//    {
//        $this->itemsTotalCount = $itemsTotalCount;
//
//        return $this;
//    }

    /**
     * @return Pagination
     */
    public function getPagination(): Pagination
    {
        return $this->pagination;
    }

    /**
     * @param Pagination $pagination
     */
    public function setPagination(Pagination $pagination): self
    {
        $this->pagination = $pagination;

        return $this;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param array $items
     * @return $this
     */
    public function setItems(array $items): self
    {
        $this->items = $items;

        return $this;
    }
}
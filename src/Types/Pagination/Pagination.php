<?php

namespace AllrivalSDK\Types\Pagination;
use AllrivalSDK\Types\TypeInterface;

class Pagination implements TypeInterface
{
    private int $page;
    private int $pagesCount;
    private $perPage;
    private int $itemsCount;
    private int $itemsTotalCount;
    private array $items;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->page = 1;
        $this->perPage = 100;
    }


    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage(int $page): self
    {
        $this->page = $page;

        return $this;
    }

    /**
     * @return int
     */
    public function getPagesCount(): int
    {
        return $this->pagesCount;
    }

    /**
     * @param int $pagesCount
     */
    public function setPagesCount(int $pagesCount): self
    {
        $this->pagesCount = $pagesCount;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * @param mixed $perPage
     */
    public function setPerPage($perPage): self
    {
        $this->perPage = $perPage;

        return $this;
    }

    /**
     * @return int
     */
    public function getItemsCount(): int
    {
        return $this->itemsCount;
    }

    /**
     * @param int $itemsCount
     */
    public function setItemsCount(int $itemsCount): self
    {
        $this->itemsCount = $itemsCount;

        return $this;
    }

    /**
     * @return int
     */
    public function getItemsTotalCount(): int
    {
        return $this->itemsTotalCount;
    }

    /**
     * @param int $itemsTotalCount
     */
    public function setItemsTotalCount(int $itemsTotalCount): self
    {
        $this->itemsTotalCount = $itemsTotalCount;

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
     */
    public function setItems(array $items): self
    {
        $this->items = $items;

        return $this;
    }
}
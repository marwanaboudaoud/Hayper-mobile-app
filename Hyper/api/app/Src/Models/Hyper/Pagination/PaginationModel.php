<?php


namespace App\Src\Models\Hyper\Pagination;

use Illuminate\Support\Collection;

class PaginationModel
{
    /**
     * @var int
     */
    private $page;

    /**
     * @var int
     */
    private $limit;

    /**
     * @var int
     */
    private $totalItems;

    /**
     * @var string
     */
    private $orderBy;

    /**
     * @var string
     */
    private $direction;

    /**
     * @var Collection
     */
    private $search;

    /**
     * @var Collection
     */
    private $items;

    /**
     * @return string
     */
    public function getOrderBy(): ?string
    {
        return $this->orderBy;
    }

    /**
     * @param  string $orderBy
     * @return PaginationModel
     */
    public function setOrderBy(?string $orderBy): PaginationModel
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    /**
     * @return string
     */
    public function getDirection(): string
    {
        return $this->direction;
    }

    /**
     * @param  string $direction
     * @return PaginationModel
     */
    public function setDirection(?string $direction): PaginationModel
    {
        if (!$direction || strtolower($direction) !== 'asc' && strtolower($direction) !== 'desc') {
            $direction = 'asc';
        }

        $this->direction = $direction;
        return $this;
    }



    /**
     * @return int
     */
    public function getPage(): ?int
    {
        return $this->page;
    }

    /**
     * @param  int $page
     * @return PaginationModel
     */
    public function setPage(?int $page): PaginationModel
    {
        if (!$page || $page < 1) {
            $page = 1;
        }

        $this->page = $page;
        return $this;
    }

    /**
     * @return int
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * @param  int $limit
     * @return PaginationModel
     */
    public function setLimit(?int $limit): PaginationModel
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getItems(): ?Collection
    {
        return $this->items;
    }

    /**
     * @param  Collection $items
     * @return PaginationModel
     */
    public function setItems(?Collection $items): PaginationModel
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getSearch(): ?Collection
    {
        return $this->search;
    }

    /**
     * @param  Collection $search
     * @return PaginationModel
     */
    public function setSearch(?Collection $search): PaginationModel
    {
        $this->search = $search;

        return $this;
    }

    /**
     * @return int
     */
    public function getTotalPages(): ?int
    {
        if (!$this->getLimit()) {
            return 0;
        }

        return ceil($this->getTotalItems() / $this->getLimit());
    }


    /**
     * @return int
     */
    public function getTotalItems(): ?int
    {
        return $this->totalItems;
    }

    /**
     * @param int $totalItems
     * @return PaginationModel
     */
    public function setTotalItems(?int $totalItems): PaginationModel
    {
        $this->totalItems = $totalItems;
        return $this;
    }
}

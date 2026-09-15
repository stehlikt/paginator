<?php declare(strict_types=1);

namespace Paginator;

final readonly class PaginationResult
{

    /**
     * @param array<int, mixed> $items
     */
    public function __construct(
        public array $items,
        public int   $currentPage,
        public int   $perPage,
        public int   $itemsCount,
        public int   $pagesCount,
        public int   $offset,
    ) {
    }

    public function hasPreviousPage(): bool
    {
        return $this->currentPage > 1;
    }

    public function hasNextPage(): bool
    {
        return $this->currentPage < $this->pagesCount;
    }

    public function firstItemNumber(): int
    {
        return $this->itemsCount === 0 ? 0 : $this->offset + 1;
    }

    public function lastItemNumber(): int
    {
        return min($this->offset + $this->perPage, $this->itemsCount);
    }

}

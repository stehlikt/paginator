<?php declare(strict_types=1);

namespace Paginator;

final readonly class Paginator
{

    const DEFAULT_PAGE = 1;
    const DEFAULT_PER_PAGE = 20;
    const MAXIMUM_PER_PAGE = 100;

    public function __construct(
        private PageDataProviderInterface $dataProvider,
    ) {
    }

    public function paginate(int $page, int $perPage): PaginationResult
    {
        $this->validatePerPage($perPage);
        $page = max(1, $page);

        $totalItemsCount = $this->dataProvider->getCount();

        if ($totalItemsCount === 0) {
            return new PaginationResult(
                items: [],
                currentPage: 1,
                perPage: $perPage,
                itemsCount: $totalItemsCount,
                pagesCount: 0,
                offset: 0
            );
        }

        $pagesCount = (int) ceil($totalItemsCount / $perPage);

        $page = min($page, $pagesCount);

        $offset = ($page - 1) * $perPage;

        $items = $this->dataProvider->getPage($offset, $perPage);
        return new PaginationResult(
            items: $items,
            currentPage: $page,
            perPage: $perPage,
            itemsCount: $totalItemsCount,
            pagesCount: $pagesCount,
            offset: $offset
        );
    }

    private function validatePerPage(int $perPage): void
    {
        if ($perPage <= 0) {
            throw new \InvalidArgumentException('Počet položek na stránku musí být větší než 0. Zadali jste: ' . $perPage);
        }

        if ($perPage > self::MAXIMUM_PER_PAGE) {
            throw new \InvalidArgumentException('Počet položek na stránku nesmí překročit maximální nastavený limit, kvůli možnému zahlcení databáze');
        }
    }

}

<?php declare(strict_types=1);

namespace Paginator;

interface PageDataProviderInterface
{

    public function getCount(): int;

    /**
     * @return array<int, mixed>
     */
    public function getPage(int $offset, int $limit): array;

}

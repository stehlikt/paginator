<?php declare(strict_types=1);

namespace Tests\Paginator;

final class PaginatorTest extends \PHPUnit\Framework\TestCase
{

    private array $testArray = ['a', 'b', 'c'];

    public function testPaginatesFirstPageCorrectly(): void
    {
        $testData = $this->createTestDataProvider($this->testArray);
        $paginator = new \Paginator\Paginator($testData);

        $result = $paginator->paginate(page: 1, perPage: 2);

        $this->assertSame(3, $result->itemsCount);
        $this->assertSame(2, $result->pagesCount);
        $this->assertSame(['a', 'b'], $result->items);
    }

    public function testThrowsExceptionWhenPerPageIsBelowMinimum(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $testData = $this->createTestDataProvider($this->testArray);
        $paginator = new \Paginator\Paginator($testData);

        $paginator->paginate(page: 1, perPage: -1);
    }

    public function testThrowsExceptionWhenPerPageExceedsMaximum(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $testData = $this->createTestDataProvider($this->testArray);
        $paginator = new \Paginator\Paginator($testData);

        $paginator->paginate(page: 1, perPage: 101);
    }

    public function testReturnsEmptyResultForEmptyDataSet(): void
    {
        $testData = $this->createTestDataProvider([]);
        $paginator = new \Paginator\Paginator($testData);

        $result = $paginator->paginate(page: 1, perPage: 20);

        $this->assertSame(0, $result->itemsCount);
        $this->assertSame(0, $result->pagesCount);
        $this->assertSame(1, $result->currentPage);
        $this->assertSame([], $result->items);
    }

    public function testClampsPageNumberToLastPageWhenOutOfRange(): void
    {
        $testData = $this->createTestDataProvider($this->testArray);
        $paginator = new \Paginator\Paginator($testData);

        $result = $paginator->paginate(page: 99, perPage: 2);

        $this->assertSame(2, $result->currentPage);
    }

    private function createTestDataProvider(array $items): \Paginator\PageDataProviderInterface
    {
        return new class ($items) implements \Paginator\PageDataProviderInterface {
            public function __construct(
                private readonly array $items,
            ) {
            }

            public function getCount(): int
            {
                return count($this->items);
            }

            public function getPage(int $offset, int $limit): array
            {
                return array_slice($this->items, $offset, $limit);
            }
        };
    }

}

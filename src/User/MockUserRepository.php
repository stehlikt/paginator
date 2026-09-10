<?php declare(strict_types=1);

namespace User;

final class MockUserRepository implements \Paginator\PageDataProviderInterface
{

    /**
     * @var array<int, User>
     */
    private array $users;

    public function __construct()
    {
        $this->users = $this->createUsers();
    }

    public function getCount(): int
    {
        return count($this->users);
    }

    public function getPage(int $offset, int $limit): array
    {
        return array_slice($this->users, $offset, $limit);
    }

    /**
     * @return array<int, User>
     */
    private function createUsers(): array
    {
        $users = [];
        for ($i = 0; $i < 50; $i++) {
            $users[] = new User(
                (string)$i,
                'User ' . $i,
                'user' . $i . '@example.com',
            );
        }

        return $users;
    }

}

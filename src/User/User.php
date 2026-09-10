<?php declare(strict_types=1);

namespace User;

final readonly class User
{

    public function __construct(
        public string $id,
        public string $username,
        public string $email,
    ) {
    }

}

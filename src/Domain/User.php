<?php

declare(strict_types=1);

namespace App\Domain;

class User
{
    public function __construct(
        public readonly int $id,
        public readonly string $firstname,
        public readonly string $lastname,
        public readonly string $email
    ) {
    }
}

<?php

declare(strict_types=1);

namespace App\Domain;

class Site
{
    public function __construct(
        public readonly int $id,
        public readonly string $url
    ) {
    }
}

<?php

declare(strict_types=1);

namespace App\Entity;

class Site
{
    public function __construct(
        public readonly int $id,
        public readonly string $url
    ) {
    }
}

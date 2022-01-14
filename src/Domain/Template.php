<?php

declare(strict_types=1);

namespace App\Domain;

class Template
{
    public function __construct(
        public readonly int $id,
        public readonly string $subject,
        public readonly string $content
    ) {
    }
}

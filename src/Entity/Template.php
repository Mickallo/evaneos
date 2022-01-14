<?php
declare(strict_types=1);

namespace App\Entity;

class Template
{
    public function __construct(
        public readonly int $id,
        public string $subject,
        public string $content
    ) {
    }
}

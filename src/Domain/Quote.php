<?php

declare(strict_types=1);

namespace App\Domain;

class Quote
{
    public function __construct(
        public readonly int $id,
        public readonly int $siteId,
        public readonly int $destinationId,
        public readonly \DateTimeInterface $dateQuoted
    ) {
    }
}

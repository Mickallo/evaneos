<?php
declare(strict_types=1);

namespace App\Entity;

class Destination
{
    public function __construct(
        public readonly int $id,
        public readonly string $countryName,
        public readonly string $conjunction,
        public readonly string $computerName
    ) {
    }
}

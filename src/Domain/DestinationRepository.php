<?php

declare(strict_types=1);

namespace App\Domain;

interface DestinationRepository
{
    public function getById(int $id): Destination;
}

<?php

declare(strict_types=1);

namespace App\Domain;

interface QuoteRepository
{
    public function getById(int $id): Quote;
}

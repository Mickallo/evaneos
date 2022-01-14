<?php

declare(strict_types=1);

namespace App\Domain;

interface SiteRepository
{
    public function getById(int $id): Site;
}

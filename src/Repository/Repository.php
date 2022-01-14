<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Destination;
use App\Entity\Quote;
use App\Entity\Site;

interface Repository
{
    public function getById($id);
}
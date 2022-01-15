<?php
declare(strict_types=1);

namespace App\Infra\Repository;

use App\Domain\Site;
use App\Domain\SiteRepository;
use Faker;

class SiteGeneratorRepository implements SiteRepository
{
    public function getById(int $id): Site
    {
        // DO NOT MODIFY THIS METHOD
        $faker = Faker\Factory::create();
        $faker->seed($id);
        return new Site($id, $faker->url);
    }
}

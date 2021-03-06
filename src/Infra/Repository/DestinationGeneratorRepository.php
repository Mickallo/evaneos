<?php

declare(strict_types=1);

namespace App\Infra\Repository;

use App\Domain\Destination;
use App\Domain\DestinationRepository;
use Faker;

class DestinationGeneratorRepository implements DestinationRepository
{
    public function getById(int $id): Destination
    {
        // DO NOT MODIFY THIS METHOD

        $faker = Faker\Factory::create();
        $faker->seed($id);

        return new Destination(
            $id,
            $faker->country,
            'en',
            $faker->slug()
        );
    }
}

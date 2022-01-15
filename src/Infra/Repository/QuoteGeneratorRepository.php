<?php

declare(strict_types=1);

namespace App\Infra\Repository;

use App\Domain\Quote;
use App\Domain\QuoteRepository;
use Faker;

class QuoteGeneratorRepository implements QuoteRepository
{
    public function getById(int $id): Quote
    {
        $generator = Faker\Factory::create();
        $generator->seed($id);

        return new Quote(
            $id,
            $generator->numberBetween(1, 10),
            $generator->numberBetween(1, 200),
            $generator->dateTime()
        );
    }
}

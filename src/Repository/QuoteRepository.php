<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Quote;
use App\Helper\SingletonTrait;
use Faker;

class QuoteRepository implements Repository
{
    use SingletonTrait;

    /**
     * @param int $id
     *
     * @return Quote
     */
    public function getById($id)
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

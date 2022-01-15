<?php

declare(strict_types=1);

namespace App\App\Service;

use App\Domain\Site;
use App\Domain\User;

class ApplicationContext
{
    private function __construct(
        private Site $currentSite,
        private User $currentUser
    ) {
    }

    public static function create(): self
    {
        $faker = \Faker\Factory::create();

        return new static(
            new Site($faker->randomNumber(), $faker->url),
            new User($faker->randomNumber(), $faker->firstName, $faker->lastName, $faker->email)
        );
    }

    public function getCurrentSite(): Site
    {
        return $this->currentSite;
    }

    public function getCurrentUser(): User
    {
        return $this->currentUser;
    }
}

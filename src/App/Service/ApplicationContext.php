<?php

declare(strict_types=1);

namespace App\App\Service;

use App\Domain\Site;
use App\Domain\User;
use App\Helper\SingletonTrait;

class ApplicationContext
{
    use SingletonTrait;

    private Site $currentSite;

    private User $currentUser;

    protected function __construct()
    {
        $faker = \Faker\Factory::create();
        $this->currentSite = new Site($faker->randomNumber(), $faker->url);
        $this->currentUser = new User($faker->randomNumber(), $faker->firstName, $faker->lastName, $faker->email);
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
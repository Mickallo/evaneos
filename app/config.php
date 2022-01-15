<?php

use App\App\Service\ApplicationContext;
use App\Domain\DestinationRepository;
use App\Domain\QuoteRepository;
use App\Domain\SiteRepository;
use App\Infra\Repository\DestinationGeneratorRepository;
use App\Infra\Repository\QuoteGeneratorRepository;
use App\Infra\Repository\SiteGeneratorRepository;

return [
    ApplicationContext::class => function () {return ApplicationContext::getInstance();},
    DestinationRepository::class => function () {return DestinationGeneratorRepository::getInstance();},
    QuoteRepository::class => function () {return QuoteGeneratorRepository::getInstance();},
    SiteRepository::class => function () {return SiteGeneratorRepository::getInstance();},
];

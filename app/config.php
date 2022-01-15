<?php

use App\App\Service\ApplicationContext;
use App\Domain\DestinationRepository;
use App\Domain\QuoteRepository;
use App\Domain\SiteRepository;
use App\Infra\Repository\DestinationGeneratorRepository;
use App\Infra\Repository\QuoteGeneratorRepository;
use App\Infra\Repository\SiteGeneratorRepository;

return [
    ApplicationContext::class => function () {return ApplicationContext::create();},
    DestinationRepository::class => DI\get(DestinationGeneratorRepository::class),
    QuoteRepository::class => DI\get(QuoteGeneratorRepository::class),
    SiteRepository::class => DI\get(SiteGeneratorRepository::class),
];

<?php

declare(strict_types=1);

$container = require_once __DIR__.'/../app/bootstrap.php';

use App\App\Service\TemplateManager;
use App\Domain\QuoteRepository;
use App\Domain\Template;
use Faker\Factory;

$faker = Factory::create();

$template = new Template(
    1,
    'Votre voyage avec une agence locale [quote:destination_name]',
    "
Bonjour [user:first_name],

Merci d'avoir contacté un agent local pour votre voyage [quote:destination_name].

Bien cordialement,

L'équipe Evaneos.com
www.evaneos.com
"
);

$templateManager = $container->get(TemplateManager::class);

$message = $templateManager->getTemplateComputed(
    $template,
    [
        'quote' => $container->get(QuoteRepository::class)->getById($faker->randomNumber()),
    ]
);

echo $message->subject."\n".$message->content;

<?php

declare(strict_types=1);

use App\App\Service\ApplicationContext;
use App\App\Service\TemplateManager;
use App\Domain\DestinationRepository;
use App\Domain\QuoteRepository;
use App\Domain\Template;

$container = require_once __DIR__.'/../app/bootstrap.php';

class TemplateManagerTest extends \PHPUnit\Framework\TestCase
{
    private $container;

    /**
     * Init the mocks.
     */
    public function setUp(): void
    {
        global $container;
        $this->container = $container;
    }

    /**
     * Closes the mocks.
     */
    public function tearDown(): void
    {
    }

    /**
     * @test
     */
    public function test()
    {
        $faker = Faker\Factory::create();

        $quote = $this->container->get(QuoteRepository::class)->getById($faker->randomNumber());
        $expectedDestination = $this->container->get(DestinationRepository::class)->getById($quote->destinationId);
        $expectedUser = $this->container->get(ApplicationContext::class)->getCurrentUser();
        $templateManager = $this->container->get(TemplateManager::class);

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

        $message = $templateManager->getTemplateComputed(
            $template,
            [
                'quote' => $quote,
            ]
        );

        $this->assertEquals('Votre voyage avec une agence locale '.$expectedDestination->countryName, $message->subject);
        $this->assertEquals('
Bonjour '.$expectedUser->firstname.",

Merci d'avoir contacté un agent local pour votre voyage ".$expectedDestination->countryName.".

Bien cordialement,

L'équipe Evaneos.com
www.evaneos.com
", $message->content);
    }
}

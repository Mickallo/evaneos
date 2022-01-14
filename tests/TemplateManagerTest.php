<?php

declare(strict_types=1);

use App\App\Service\ApplicationContext;
use App\App\Service\TemplateManager;
use App\Domain\Template;
use App\Infra\Repository\DestinationGeneratorRepository;
use App\Infra\Repository\QuoteGeneratorRepository;
use App\Infra\Repository\SiteGeneratorRepository;

require_once __DIR__.'/../vendor/autoload.php';

class TemplateManagerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Init the mocks.
     */
    public function setUp(): void
    {
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

        $quote = QuoteGeneratorRepository::getInstance()->getById($faker->randomNumber());
        $expectedDestination = DestinationGeneratorRepository::getInstance()->getById($quote->destinationId);
        $expectedUser = ApplicationContext::getInstance()->getCurrentUser();

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

        $templateManager = new TemplateManager(
            ApplicationContext::getInstance(),
            QuoteGeneratorRepository::getInstance(),
            DestinationGeneratorRepository::getInstance(),
            SiteGeneratorRepository::getInstance()
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

<?php

declare(strict_types=1);

use App\App\Service\ApplicationContext;
use App\App\Service\TemplateManager;
use App\Domain\Destination;
use App\Domain\DestinationRepository;
use App\Domain\Quote;
use App\Domain\QuoteRepository;
use App\Domain\Site;
use App\Domain\SiteRepository;
use App\Domain\Template;
use App\Domain\User;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TemplateManagerTest extends TestCase
{
    private QuoteRepository|MockObject $quoteRepository;
    private DestinationRepository|MockObject $destinationRepository;
    private ApplicationContext|MockObject $applicationContext;
    private SiteRepository $siteRepository;

    /**
     * Init the mocks.
     */
    public function setUp(): void
    {
        $this->applicationContext = $this
            ->getMockBuilder(ApplicationContext::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteRepository = $this
            ->getMockBuilder(QuoteRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->destinationRepository = $this
            ->getMockBuilder(DestinationRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->siteRepository = $this
            ->getMockBuilder(SiteRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * Closes the mocks.
     */
    public function tearDown(): void
    {
    }

    public function testGetTemplateComputed()
    {
        $generator = Faker\Factory::create();

        $quote = new Quote(
            $generator->numberBetween(),
            $generator->numberBetween(1, 10),
            $generator->numberBetween(1, 200),
            $generator->dateTime()
        );

        $destination = new Destination(
            $generator->numberBetween(),
            $generator->country,
            'en',
            $generator->slug()
        );

        $site = new Site($generator->randomNumber(), $generator->url);
        $user = new User($generator->randomNumber(), $generator->firstName, $generator->lastName, $generator->email);

        $this->applicationContext->method('getCurrentUser')->willReturn($user);
        $this->quoteRepository->method('getById')->willReturn($quote);
        $this->destinationRepository->method('getById')->willReturn($destination);
        $this->siteRepository->method('getById')->willReturn($site);

        $templateManager = new TemplateManager(
            $this->applicationContext,
            $this->quoteRepository,
            $this->destinationRepository,
            $this->siteRepository
        );

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
            ['quote' => $quote]
        );

        $this->assertEquals('Votre voyage avec une agence locale '.$destination->countryName, $message->subject);
        $this->assertEquals('
Bonjour '.$user->firstname.",

Merci d'avoir contacté un agent local pour votre voyage ".$destination->countryName.".

Bien cordialement,

L'équipe Evaneos.com
www.evaneos.com
", $message->content);
    }
}

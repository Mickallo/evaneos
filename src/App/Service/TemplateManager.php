<?php

declare(strict_types=1);

namespace App\App\Service;

use App\App\ViewModel\Message\MessageAssembler;
use App\App\ViewModel\ViewModel;
use App\Domain\DestinationRepository;
use App\Domain\Quote;
use App\Domain\QuoteRepository;
use App\Domain\SiteRepository;
use App\Domain\Template;
use App\Domain\User;

class TemplateManager
{
    public function __construct(
        private ApplicationContext $applicationContext,
        private QuoteRepository $quoteRepository,
        private DestinationRepository $destinationRepository,
        private SiteRepository $siteRepository
    ) {
    }

    /**
     * @return Template
     */
    public function getTemplateComputed(Template $tpl, array $data)
    {
        return $this->message(
            $tpl,
            $this->viewModelFromData($data)->value()
        );
    }

    private function viewModelFromData(array $data): ViewModel
    {
        $user = (isset($data['user']) and ($data['user'] instanceof User)) ? $data['user'] : $this->applicationContext->getCurrentUser();
        $quote = (isset($data['quote']) and $data['quote'] instanceof Quote) ? $data['quote'] : null;
        $quote = $this->quoteRepository->getById($quote->id);
        $destination = $this->destinationRepository->getById($quote->destinationId);
        $site = $this->siteRepository->getById($quote->siteId);

        return MessageAssembler::create(
            $user,
            $quote,
            $destination,
            $site
        );
    }

    private function message(Template $template, array $tags): Template
    {
        return new Template(
            $template->id,
            $this->compute($template->subject, $tags),
            $this->compute($template->content, $tags)
        );
    }

    private function compute(string $text, array $tags): string
    {
        foreach ($tags as $key => $value) {
            $tagToReplace = "[$key]";
            $text = str_replace($tagToReplace, $value, $text);
        }

        return $text;
    }
}

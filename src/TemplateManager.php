<?php

declare(strict_types=1);

namespace App;

use App\App\ViewModel\Message\MessageAssembler;
use App\App\ViewModel\ViewModel;
use App\Context\ApplicationContext;
use App\Entity\Quote;
use App\Entity\Template;
use App\Entity\User;
use App\Repository\DestinationRepository;
use App\Repository\SiteRepository;

class TemplateManager
{
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
        $applicationContext = ApplicationContext::getInstance();
        $user = (isset($data['user']) and ($data['user'] instanceof User)) ? $data['user'] : $applicationContext->getCurrentUser();
        $quote = (isset($data['quote']) and $data['quote'] instanceof Quote) ? $data['quote'] : null;
        //$quote = QuoteRepository::getInstance()->getById($quote->id);
        $destination = DestinationRepository::getInstance()->getById($quote->destinationId);
        $site = SiteRepository::getInstance()->getById($quote->siteId);

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

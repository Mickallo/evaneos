<?php

declare(strict_types=1);

namespace App\App\ViewModel\Message;

use App\App\ViewModel\ViewModel;

class MessageViewModel implements ViewModel
{
    public function __construct(
        private string $quoteSummary,
        private string $quoteSummaryHtml,
        private string $destinationName,
        private string $destinationLink,
        private string $userFirstName
    ) {
    }

    public function value(): array
    {
        return [
            'quote:summary' => $this->quoteSummary,
            'quote:summary_html' => $this->quoteSummaryHtml,
            'quote:destination_name' => $this->destinationName,
            'quote:destination_link' => $this->destinationLink,
            'user:first_name' => $this->userFirstName,
        ];
    }
}

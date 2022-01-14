<?php
declare(strict_types=1);

namespace App\Entity;

class Quote
{
    public function __construct(
        public readonly int $id,
        public readonly int $siteId,
        public readonly int $destinationId,
        public readonly \DateTimeInterface $dateQuoted
    ) {
    }

    public static function renderHtml(Quote $quote): string
    {
        return '<p>' . $quote->id . '</p>';
    }

    public static function renderText(Quote $quote): string
    {
        return (string) $quote->id;
    }
}

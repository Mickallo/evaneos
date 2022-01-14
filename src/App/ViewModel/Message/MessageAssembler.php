<?php

declare(strict_types=1);

namespace App\App\ViewModel\Message;

use App\App\ViewModel\Assembler;
use App\Domain\Destination;
use App\Domain\Quote;
use App\Domain\Site;
use App\Domain\User;

class MessageAssembler implements Assembler
{
    public static function create(
        User $user,
        Quote $quote,
        Destination $destination,
        Site $site
    ) {
        return new MessageViewModel(
            (string) $quote->id,
            '<p>'.$quote->id.'</p>',
            $destination->countryName,
            $site->url.'/'.$destination->countryName.'/quote/'.$quote->id,
            ucfirst(mb_strtolower($user->firstname))
        );
    }
}

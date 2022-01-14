<?php

declare(strict_types=1);

namespace App\App\ViewModel\Message;

use App\App\ViewModel\Assembler;
use App\Entity\Destination;
use App\Entity\Quote;
use App\Entity\Site;
use App\Entity\User;

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

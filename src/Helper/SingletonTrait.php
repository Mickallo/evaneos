<?php
declare(strict_types=1);

namespace App\Helper;

trait SingletonTrait
{
    protected static self|null $instance = null;

    public static function getInstance(): self
    {
        if (!self::$instance) {
            self::$instance = new static();
        }

        return self::$instance;
    }
}

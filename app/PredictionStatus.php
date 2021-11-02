<?php

namespace App;

use App\Helpers\EnumInterface;

class PredictionStatus implements EnumInterface
{
    public const STATUS_WIN = 'win';
    public const STATUS_LOST = 'lost';
    public const STATUS_UNRESOLVED = 'unresolved';

    public static function getAllValues(): array
    {
        return [
            self::STATUS_WIN,
            self::STATUS_LOST,
            self::STATUS_UNRESOLVED,
        ];
    }
}

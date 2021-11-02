<?php

namespace App;

use App\Helpers\EnumInterface;

class PredictionMarketType implements EnumInterface
{
    public const MARKET_TYPE_1X2 = '1x2';
    public const MARKET_TYPE_CORRECT_SCORE = 'correct_score';

    public static function getAllValues(): array
    {
        return [
            self::MARKET_TYPE_1X2,
            self::MARKET_TYPE_CORRECT_SCORE
        ];
    }
}

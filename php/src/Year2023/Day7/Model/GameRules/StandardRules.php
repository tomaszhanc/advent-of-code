<?php

declare(strict_types=1);

namespace Advent\Year2023\Day7\Model\GameRules;

use Advent\Year2023\Day7\Model\Card;
use Advent\Year2023\Day7\Model\GameRules;

final readonly class StandardRules implements GameRules
{
    private const array STANDARD_STRENGTH = [
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        '6' => 6,
        '7' => 7,
        '8' => 8,
        '9' => 9,
        'T' => 10,
        'J' => 11,
        'Q' => 12,
        'K' => 13,
        'A' => 14,
    ];

    public function cardStrength(Card $card): int
    {
        return self::STANDARD_STRENGTH[$card->card];
    }
}

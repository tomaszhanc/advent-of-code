<?php

declare(strict_types=1);

namespace Advent\Year2023\Day7\Model\GameRules;

use Advent\Year2023\Day7\Model\Card;
use Advent\Year2023\Day7\Model\GameRules;

final readonly class JokerInPlay implements GameRules
{
    public function cardStrength(Card $card): int
    {
        $rules = new StandardRules();

        if ($card->card === 'J') {
            return $rules->cardStrength(new Card('2')) - 1;
        }

        return $rules->cardStrength($card);
    }
}

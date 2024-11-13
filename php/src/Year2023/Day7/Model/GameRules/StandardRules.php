<?php

declare(strict_types=1);

namespace Advent\Year2023\Day7\Model\GameRules;

use Advent\Year2023\Day7\Model\Card;
use Advent\Year2023\Day7\Model\GameRules;
use Advent\Year2023\Day7\Model\Hand;
use Advent\Year2023\Day7\Model\HandStrength;

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
        return self::STANDARD_STRENGTH[$card->toString()];
    }

    public function handStrength(Hand $hand): HandStrength
    {
        $cardOccurrence = $hand->cardOccurrence();

        if ($cardOccurrence->theMostOccurrences() === 5) {
            return HandStrength::FIVE_OF_A_KIND;
        }

        if ($cardOccurrence->theMostOccurrences() === 4) {
            return HandStrength::FOUR_OF_A_KIND;
        }

        if ($cardOccurrence->theMostOccurrences() === 3) {
            if ($cardOccurrence->secondMostOccurrences() === 2) {
                return HandStrength::FULL_HOUSE;
            }

            return HandStrength::THREE_OF_A_KIND;
        }

        if ($cardOccurrence->theMostOccurrences() === 2) {
            if ($cardOccurrence->secondMostOccurrences() === 2) {
                return HandStrength::TWO_PAIR;
            }

            return HandStrength::ONE_PAIR;
        }

        return HandStrength::HIGH_CARD;
    }
}

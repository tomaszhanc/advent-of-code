<?php

declare(strict_types=1);

namespace Advent\Year2023\Day7\Model\GameRules;

use Advent\Year2023\Day7\Model\Card;
use Advent\Year2023\Day7\Model\GameRules;
use Advent\Year2023\Day7\Model\Hand;
use Advent\Year2023\Day7\Model\HandStrength;

final readonly class JokerInPlay implements GameRules
{
    private StandardRules $standardRules;

    public function __construct()
    {
        $this->standardRules = new StandardRules();
    }

    public function cardStrength(Card $card): int
    {
        if ($card->is('J')) {
            return $this->standardRules->cardStrength(new Card('2')) - 1;
        }

        return $this->standardRules->cardStrength($card);
    }

    public function handStrength(Hand $hand): HandStrength
    {
        $cardOccurrence = $hand->cardOccurrence();

        if ($cardOccurrence->theMostOccurredCard()->is('J')) {
            if ($cardOccurrence->theMostOccurrences() === 5) {
                return HandStrength::FIVE_OF_A_KIND;
            }

            return $this->standardRules->handStrength(
                $hand->replaceJokersWith($cardOccurrence->secondMostOccurredCard())
            );
        }

        return $this->standardRules->handStrength(
            $hand->replaceJokersWith($cardOccurrence->theMostOccurredCard())
        );
    }
}

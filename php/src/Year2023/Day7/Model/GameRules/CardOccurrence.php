<?php

declare(strict_types=1);

namespace Advent\Year2023\Day7\Model\GameRules;

use Advent\Year2023\Day7\Model\Card;

final readonly class CardOccurrence
{
    /**
     * @var array<string, int>
     *   Example: [
     *      'A' => 2
     *      'Q' => 2
     *      '3' => 1
     *   ]
     */
    private array $cardOccurrence;

    public function __construct(Card ...$cards)
    {
        $cardOccurrence = array_count_values(array_map(fn (Card $card) => $card->toString(), $cards));
        arsort($cardOccurrence);
        $this->cardOccurrence = $cardOccurrence;
    }

    public function theMostOccurredCard(): Card
    {
        $firstCard = array_keys($this->cardOccurrence)[0];

        return new Card((string) $firstCard);
    }

    public function theMostOccurrences(): int
    {
        $firstCard = array_keys($this->cardOccurrence)[0];

        return $this->cardOccurrence[$firstCard];
    }

    public function secondMostOccurredCard(): Card
    {
        $secondCard = array_keys($this->cardOccurrence)[1];

        return new Card((string) $secondCard);
    }

    public function secondMostOccurrences(): int
    {
        $secondCard = array_keys($this->cardOccurrence)[1];

        return $this->cardOccurrence[$secondCard];
    }
}

<?php

declare(strict_types=1);

namespace Advent\Year2023\Day7\Model;

use Advent\Shared\RuntimeException;

final readonly class Hand
{
    /** @var string[] */
    private array $cards;

    public function __construct(
        public int $bid,
        Card ...$cards,
    ) {
        if (count($cards) !== 5) {
            throw RuntimeException::because('Hand must have 5 cards');
        }

        $this->cards = array_map(
            fn (Card $card) => $card->card,
            $cards
        );
    }

    public static function of(string $hand, int $bid): self
    {
        return new self(
            $bid,
            ...array_map(
                fn (string $card) => new Card($card),
                str_split($hand, 1)
            )
        );
    }

    public function card(int $i): Card
    {
        if ($i < 1 || $i > 5) {
            throw RuntimeException::because('Card "%d" does not exist.', $i);
        }

        return new Card($this->cards[$i - 1]);
    }

    public function type(): HandType
    {
        $cardOccurrence = array_count_values($this->cards);
        rsort($cardOccurrence);
        $mostOccurrences = array_shift($cardOccurrence);

        if ($mostOccurrences === 5) {
            return HandType::FIVE_OF_A_KIND;
        }

        if ($mostOccurrences === 4) {
            return HandType::FOUR_OF_A_KIND;
        }

        if ($mostOccurrences === 3) {
            if (array_shift($cardOccurrence) === 2) {
                return HandType::FULL_HOUSE;
            }

            return HandType::THREE_OF_A_KIND;
        }

        if ($mostOccurrences === 2) {
            if (array_shift($cardOccurrence) === 2) {
                return HandType::TWO_PAIR;
            }

            return HandType::ONE_PAIR;
        }

        return HandType::HIGH_CARD;
    }
}

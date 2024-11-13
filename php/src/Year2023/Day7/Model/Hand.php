<?php

declare(strict_types=1);

namespace Advent\Year2023\Day7\Model;

use Advent\Shared\RuntimeException;
use Advent\Year2023\Day7\Model\GameRules\CardOccurrence;

final readonly class Hand
{
    public int $bid;

    /** @var Card[] */
    private array $cards;

    public function __construct(int $bid, Card ...$cards)
    {
        if (count($cards) !== 5) {
            throw RuntimeException::because('Hand must have 5 cards');
        }

        $this->bid = $bid;
        $this->cards = $cards;
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

        return $this->cards[$i - 1];
    }

    public function replaceJokersWith(Card $card): self
    {
        return new self(
            $this->bid,
            ...array_map(
                fn (Card $next) => $next->is('J') ? $card : $next,
                $this->cards
            )
        );
    }

    public function cardOccurrence(): CardOccurrence
    {
        return new CardOccurrence(...$this->cards);
    }
}

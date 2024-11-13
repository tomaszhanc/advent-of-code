<?php

declare(strict_types=1);

namespace Advent\Year2023\Day7\Model;

use Advent\Shared\RuntimeException;

final readonly class Card
{
    public function __construct(private string $card)
    {
        if (!in_array($card, ['2','3','4','5','6','7','8','9','T','J','Q','K','A'])) {
            throw RuntimeException::because('Card "%s" is invalid.', $card);
        }
    }

    public function is(string $card): bool
    {
        return $this->card === $card;
    }

    public function toString(): string
    {
        return $this->card;
    }
}

<?php

declare(strict_types=1);

namespace Advent\Year2023\Day7\Model;

use Advent\Shared\RuntimeException;

final readonly class Card
{
    public function __construct(public string $card)
    {
        if (!in_array($card, ['2','3','4','5','6','7','8','9','T','J','Q','K','A'])) {
            throw RuntimeException::because('Card "%s" is invalid.', $card);
        }
    }

    public function strength(GameRules $rules): int
    {
        return $rules->cardStrength($this);
    }
}

<?php

declare(strict_types=1);

namespace Advent\Year2023\Day7\Model;

use Advent\Shared\RuntimeException;

final readonly class Card
{
    private const array STRENGTH = [
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

    public function __construct(public string $card)
    {
        if (!in_array($card, ['2','3','4','5','6','7','8','9','T','J','Q','K','A'])) {
            throw RuntimeException::because('Card "%s" is invalid.', $card);
        }
    }

    public function strength(): int
    {
        return self::STRENGTH[$this->card];
    }
}

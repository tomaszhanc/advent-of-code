<?php

declare(strict_types=1);

namespace AoC\Year2023\Day1;

use AoC\Common\InvalidArgumentException;

final readonly class Digit
{
    private const array DIGITS = [
        'zero' => 0,
        'one' => 1,
        'two' => 2,
        'three' => 3,
        'four' => 4,
        'five' => 5,
        'six' => 6,
        'seven' => 7,
        'eight' => 8,
        'nine' => 9,
    ];

    public function __construct(private int $digit)
    {
        if ($this->digit < 0 || $this->digit > 9) {
            throw InvalidArgumentException::because('Digit must be between 0 and 9. Given: %s', $this->digit);
        }
    }

    public static function fromString(string $digit): self
    {
        if (\is_numeric($digit)) {
            return new self((int) $digit);
        }

        if (!isset(self::DIGITS[$digit])) {
            throw InvalidArgumentException::because('Digit spelled out with letters must be between 0 and 9. Given: %s', $digit);
        }

        return new self(self::DIGITS[$digit]);
    }

    public function asInteger(): int
    {
        return $this->digit;
    }
}

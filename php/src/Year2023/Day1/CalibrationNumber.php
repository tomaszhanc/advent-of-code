<?php

declare(strict_types=1);

namespace AoC\Year2023\Day1;

final readonly class CalibrationNumber
{
    public function __construct(private Digit $first, private Digit $last)
    {
    }

    public function asInteger(): int
    {
        return (int) ($this->first->asInteger() . $this->last->asInteger());
    }
}

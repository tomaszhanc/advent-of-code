<?php

declare(strict_types=1);

namespace Advent\Year2023\Day1\Model;

final readonly class CalibrationValue
{
    public function __construct(
        private Digit $first,
        private Digit $last
    ) {
    }

    public function asInteger(): int
    {
        return (int) ($this->first->asInteger() . $this->last->asInteger());
    }
}

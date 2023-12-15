<?php

declare(strict_types=1);

namespace AoC\Year2023\Day1\CalibrationDocument;

final readonly class CalibrationValue
{
    public function __construct(
        private Digit $first,
        private Digit $last
    ) {
    }

    public static function of(int $first, int $last): self
    {
        return new self(new Digit($first), new Digit($last));
    }

    public function asInteger(): int
    {
        return (int) ($this->first->asInteger() . $this->last->asInteger());
    }
}
<?php

declare(strict_types=1);

namespace Advent\Shared\Interpreter;

final readonly class Number implements Expression
{
    public function __construct(
        private int $number
    ) {
    }

    public function interpret(): int
    {
        return $this->number;
    }
}

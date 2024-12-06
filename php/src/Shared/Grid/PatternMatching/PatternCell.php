<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\PatternMatching;

final class PatternCell
{
    public function __construct(
        public int $x,
        public int $y,
        public string $value
    ) {
    }

    public function mustMatch(): bool
    {
        return $this->value !== '.';
    }
}

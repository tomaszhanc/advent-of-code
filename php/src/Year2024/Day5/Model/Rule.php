<?php

declare(strict_types=1);

namespace Advent\Year2024\Day5\Model;

final readonly class Rule
{
    public function __construct(
        public int $left,
        public int $right
    ) {
    }
}

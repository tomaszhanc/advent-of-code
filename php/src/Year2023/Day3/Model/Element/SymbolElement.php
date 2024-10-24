<?php

declare(strict_types=1);

namespace Advent\Year2023\Day3\Model\Element;

final readonly class SymbolElement
{
    public function __construct(
        public int $lineNumber,
        public int $position,
        public string $symbol
    ) {
    }
}

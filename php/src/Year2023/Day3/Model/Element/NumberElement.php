<?php

declare(strict_types=1);

namespace Advent\Year2023\Day3\Model\Element;

use Advent\Shared\Grid\Cell;
use Advent\Shared\Grid\Line\HorizontalLine;

final readonly class NumberElement
{
    public function __construct(
        public int $lineNumber,
        public int $position,
        public int $number
    ) {
    }

    public function isAdjacentTo(SymbolElement $symbolElement): bool
    {
        $symbol = new Cell($symbolElement->position, $symbolElement->lineNumber);

        if ($this->length() === 1) {
            $number = new Cell($this->position, $this->lineNumber);
            return $number->isAdjacentTo($symbol);
        }

        $number = HorizontalLine::ofLength(
            new Cell($this->position, $this->lineNumber),
            $this->length()
        );

        return $number->isAdjacentTo($symbol);
    }

    private function length(): int
    {
        return strlen((string) $this->number);
    }
}

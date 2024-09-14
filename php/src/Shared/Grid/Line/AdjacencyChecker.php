<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Line;

use Advent\Shared\Grid\Cell;

/** @internal */
final readonly class AdjacencyChecker
{
    private function __construct(
        private int $distanceFromRange,
        private int $rangeStartPosition,
        private int $rangeEndPosition,
        private int $cellPosition
    ) {
    }

    public static function forHorizontalLine(HorizontalLine $line, Cell $cell): self
    {
        return new self(
            abs($line->startCell->rowIndex - $cell->rowIndex),
            $line->startCell->columnIndex,
            $line->endCell->columnIndex,
            $cell->columnIndex
        );
    }

    public static function forVerticalLine(VerticalLine $line, Cell $cell): self
    {
        return new self(
            abs($line->startCell->columnIndex - $cell->columnIndex),
            $line->startCell->rowIndex,
            $line->endCell->rowIndex,
            $cell->rowIndex
        );
    }

    public function isAdjacent(): bool
    {
        if ($this->distanceFromRange > 1) {
            return false;
        }

        if ($this->distanceFromRange === 0) {
            return $this->cellPosition === $this->rangeStartPosition - 1
                || $this->cellPosition === $this->rangeEndPosition + 1;
        }

        return $this->cellPosition >= $this->rangeStartPosition - 1
            && $this->cellPosition <= $this->rangeEndPosition + 1;
    }
}

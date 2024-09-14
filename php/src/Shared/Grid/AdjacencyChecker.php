<?php

declare(strict_types=1);

namespace Advent\Shared\Grid;

use Advent\Shared\Parser\InvalidArgumentException;

final readonly class AdjacencyChecker
{
    private function __construct(
        private int $distanceFromRange,
        private int $rangeStartPosition,
        private int $rangeEndPosition,
        private int $cellPosition
    ) {
    }

    public static function forHorizontalLine(Line $line, Cell $cell): self
    {
        if ($line->startCell->rowIndex !== $line->endCell->rowIndex) {
            throw InvalidArgumentException::because('Given range must be horizontal');
        }

        return new self(
            abs($line->startCell->rowIndex - $cell->rowIndex),
            $line->startCell->columnIndex,
            $line->endCell->columnIndex,
            $cell->columnIndex
        );
    }

    public static function forVerticalLine(Line $range, Cell $cell): self
    {
        if ($range->startCell->columnIndex !== $range->endCell->columnIndex) {
            throw InvalidArgumentException::because('Given range must be vertical');
        }

        return new self(
            abs($range->startCell->columnIndex - $cell->columnIndex),
            $range->startCell->rowIndex,
            $range->endCell->rowIndex,
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

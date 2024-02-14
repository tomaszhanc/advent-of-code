<?php

declare(strict_types=1);

namespace AoC\Common\Range;

use AoC\Common\Cell;
use AoC\Common\InvalidArgumentException;
use AoC\Common\Range;

final readonly class CallAdjacencyChecker
{
    private function __construct(
        private int $distanceFromRange,
        private int $rangeStartPosition,
        private int $rangeEndPosition,
        private int $cellPosition
    ) {
    }

    public static function forHorizontalRange(Range $range, Cell $cell) : self
    {
        if ($range->start->row !== $range->end->row) {
            throw InvalidArgumentException::because('Given range must be horizontal');
        }

        return new self(
            abs($range->start->row - $cell->row),
            $range->start->column,
            $range->end->column,
            $cell->column
        );
    }

    public static function forVerticalRange(Range $range, Cell $cell) : self
    {
        if ($range->start->column !== $range->end->column) {
            throw InvalidArgumentException::because('Given range must be vertical');
        }

        return new self(
            abs($range->start->column - $cell->column),
            $range->start->row,
            $range->end->row,
            $cell->row
        );
    }

    public function isAdjacent() : bool
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

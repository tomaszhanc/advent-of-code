<?php

declare(strict_types=1);

namespace AoC\Common;

use AoC\Common\Range\CallAdjacencyChecker;

final readonly class Range
{
    public function __construct(
        public Cell $start,
        public Cell $end
    ) {
        if ($start->column > $end->column) {
            throw InvalidArgumentException::because('Start column must be less than or equal to End column');
        }

        if ($start->column !== $end->column && $start->row !== $end->row) {
            throw InvalidArgumentException::because('Diagonal ranges are not supported');
        }
    }

    public function isAdjacentTo(Cell $cell) : bool
    {
        if ($this->start->row === $this->end->row) {
            return CallAdjacencyChecker::forHorizontalRange($this, $cell)->isAdjacent();
        }

        return CallAdjacencyChecker::forVerticalRange($this, $cell)->isAdjacent();
    }
}

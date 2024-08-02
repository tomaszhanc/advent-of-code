<?php

declare(strict_types=1);

namespace AoC\Common;

final readonly class Cell
{
    public function __construct(
        public int $column,
        public int $row,
    ) {
        if ($column < 0) {
            throw new \InvalidArgumentException('Column must be greater than or equal to 0');
        }

        if ($row < 0) {
            throw new \InvalidArgumentException('Row must be greater than or equal to 0');
        }
    }

    public function isAdjacentTo(Cell $cell): bool
    {
        // the same cells are not adjacent, they overlap
        if ($this->equals($cell)) {
            return false;
        }

        $columnDistance = abs($this->column - $cell->column);
        $rowDistance = abs($this->row - $cell->row);

        return $columnDistance <= 1 && $rowDistance <= 1;
    }

    public function equals(Cell $cell): bool
    {
        return $this->column === $cell->column && $this->row === $cell->row;
    }
}

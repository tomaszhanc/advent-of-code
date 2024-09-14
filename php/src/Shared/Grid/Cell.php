<?php

declare(strict_types=1);

namespace Advent\Shared\Grid;

final readonly class Cell
{
    public function __construct(
        public int $columnIndex,
        public int $rowIndex,
    ) {
        if ($columnIndex < 0) {
            throw new \InvalidArgumentException('Column index must be greater than or equal to 0');
        }

        if ($rowIndex < 0) {
            throw new \InvalidArgumentException('Row index must be greater than or equal to 0');
        }
    }

    public function isAdjacentTo(Cell $cell): bool
    {
        // the same cells are not adjacent, they overlap
        if ($this->equals($cell)) {
            return false;
        }

        $columnDistance = abs($this->columnIndex - $cell->columnIndex);
        $rowDistance = abs($this->rowIndex - $cell->rowIndex);

        return $columnDistance <= 1 && $rowDistance <= 1;
    }

    public function equals(Cell $cell): bool
    {
        return $this->columnIndex === $cell->columnIndex
            && $this->rowIndex === $cell->rowIndex;
    }
}

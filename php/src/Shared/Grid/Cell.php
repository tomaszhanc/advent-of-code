<?php

declare(strict_types=1);

namespace Advent\Shared\Grid;

use Advent\Shared\Grid\Adjacency\ColumnAdjacency;
use Advent\Shared\Grid\Adjacency\RowAdjacency;

final readonly class Cell
{
    public function __construct(
        public int $columnIndex,
        public int $rowIndex,
    ) {
        if ($columnIndex < 0) {
            throw InvalidArgumentException::because('Column index must be greater than or equal to 0');
        }

        if ($rowIndex < 0) {
            throw InvalidArgumentException::because('Row index must be greater than or equal to 0');
        }
    }

    public function adjacencyTo(Cell $cell): Adjacency
    {
        $columnPosition = match ($this->columnIndex - $cell->columnIndex) {
            -1 => ColumnAdjacency::LEFT,
            1 =>  ColumnAdjacency::RIGHT,
            0 =>  ColumnAdjacency::SAME,
            default =>  ColumnAdjacency::DISTANT,
        };

        $rowPosition = match ($this->rowIndex - $cell->rowIndex) {
            -1 => RowAdjacency::ABOVE,
            1 =>  RowAdjacency::BELOW,
            0 =>  RowAdjacency::SAME,
            default =>  RowAdjacency::DISTANT,
        };

        return new Adjacency($columnPosition, $rowPosition);
    }

    public function isAdjacentTo(Cell $cell): bool
    {
        $cellPosition = $this->adjacencyTo($cell);

        // the same cells are not adjacent, they overlap
        if ($cellPosition->isSamePosition()) {
            return false;
        }

        if ($cellPosition->isDistant()) {
            return false;
        }

        return true;
    }

    public function equals(Cell $cell): bool
    {
        return $this->columnIndex === $cell->columnIndex
            && $this->rowIndex === $cell->rowIndex;
    }
}

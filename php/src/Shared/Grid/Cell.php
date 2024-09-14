<?php

declare(strict_types=1);

namespace Advent\Shared\Grid;

use Advent\Shared\Grid\Position\ColumnPosition;
use Advent\Shared\Grid\Position\RowPosition;

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

    // fixme test
    public function positionTo(Cell $cell): RelativePosition
    {
        $columnPosition = match ($this->columnIndex - $cell->columnIndex) {
            -1 => ColumnPosition::LEFT,
            1 =>  ColumnPosition::RIGHT,
            0 =>  ColumnPosition::SAME,
            default =>  ColumnPosition::DETACHED,
        };

        $rowPosition = match ($this->rowIndex - $cell->rowIndex) {
            -1 => RowPosition::ABOVE,
            1 =>  RowPosition::BELOW,
            0 =>  RowPosition::SAME,
            default =>  RowPosition::DETACHED,
        };

        return new RelativePosition($columnPosition, $rowPosition);
    }

    public function isAdjacentTo(Cell $cell): bool
    {
        $cellPosition = $this->positionTo($cell);

        // the same cells are not adjacent, they overlap
        if ($cellPosition->isSamePosition()) {
            return false;
        }

        if ($cellPosition->isDetached()) {
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

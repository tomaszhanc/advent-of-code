<?php

declare(strict_types=1);

namespace Advent\Shared\Grid;

use Advent\Shared\Grid\Position\ColumnPosition;
use Advent\Shared\Grid\Position\RowPosition;

final readonly class RelativePosition
{
    public function __construct(
        public ColumnPosition $column,
        public RowPosition $row
    ) {
    }

    public function isSamePosition(): bool
    {
        return $this->row->isSame() && $this->column->isSame();
    }

    public function isDetached(): bool
    {
        return $this->column->isDetached() || $this->row->isDetached();
    }

    public function isDirectlyLeft(): bool
    {
        return $this->row->isSame() && $this->column->isLeft();
    }

    public function isDirectlyRight(): bool
    {
        return $this->row->isSame() && $this->column->isRight();
    }

    public function isDirectlyAbove(): bool
    {
        return $this->row->isAbove() && $this->column->isSame();
    }

    public function isDirectlyBelow(): bool
    {
        return $this->row->isBelow() && $this->column->isSame();
    }

    public function isRowAdjacent(): bool
    {
        return $this->row->isAbove() || $this->row->isBelow();
    }

    public function isColumnAdjacent(): bool
    {
        return $this->column->isLeft() || $this->column->isRight();
    }
}

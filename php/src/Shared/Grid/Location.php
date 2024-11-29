<?php

declare(strict_types=1);

namespace Advent\Shared\Grid;

use Advent\Shared\Grid\Adjacency\ColumnAdjacency;
use Advent\Shared\Grid\Adjacency\RowAdjacency;

final readonly class Location
{
    public function __construct(
        public int $x,
        public int $y,
    ) {
    }

    public function equalsTo(self $location): bool
    {
        return $this->x === $location->x && $this->y === $location->y;
    }

    public function neighbourAt(Direction $direction): self
    {
        $offsetX = $offsetY = 0;

        if ($direction->is(Direction::UP)) {
            $offsetY = -1;
        }

        if ($direction->is(Direction::DOWN)) {
            $offsetY = +1;
        }

        if ($direction->is(Direction::LEFT)) {
            $offsetX = -1;
        }

        if ($direction->is(Direction::RIGHT)) {
            $offsetX = +1;
        }

        return $this->moveBy($offsetX, $offsetY);
    }

    public function moveBy(int $offsetX, int $offsetY): self
    {
        return new self($this->x + $offsetX, $this->y + $offsetY);
    }

    public function toString(): string
    {
        return sprintf('{%d, %d}', $this->x, $this->y);
    }

    // FIXME Do I need those below?

    public function isAdjacentTo(Location $cell): bool
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

    public function adjacencyTo(Location $location): Adjacency
    {
        $columnPosition = match ($this->x - $location->x) {
            -1 => ColumnAdjacency::LEFT,
            1 =>  ColumnAdjacency::RIGHT,
            0 =>  ColumnAdjacency::SAME,
            default =>  ColumnAdjacency::DISTANT,
        };

        $rowPosition = match ($this->y - $location->y) {
            -1 => RowAdjacency::ABOVE,
            1 =>  RowAdjacency::BELOW,
            0 =>  RowAdjacency::SAME,
            default =>  RowAdjacency::DISTANT,
        };

        return new Adjacency($columnPosition, $rowPosition);
    }
}

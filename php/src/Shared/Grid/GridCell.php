<?php

declare(strict_types=1);

namespace Advent\Shared\Grid;

interface GridCell
{
    public function location(): Location;

    /**
     * Checks if it is possible to move in the given direction from this cell.
     */
    public function canMoveTo(Direction $direction): bool;

    /**
     * Gets the directions in which it is possible to move from this cell.
     *
     * @return Direction[]
     */
    public function possibleDirections(): array;
}

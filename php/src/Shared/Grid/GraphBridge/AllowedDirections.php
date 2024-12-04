<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\GraphBridge;

use Advent\Shared\Grid\Cell;
use Advent\Shared\Grid\Directions;

interface AllowedDirections
{
    /**
     * Gets the directions in which it is possible to move from the given cell.
     */
    public function for(Cell $cell): Directions;
}

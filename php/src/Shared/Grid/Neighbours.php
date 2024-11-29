<?php

declare(strict_types=1);

namespace Advent\Shared\Grid;

interface Neighbours
{
    /** @return Location[] */
    public function for(GridCell $cell, GridCells $cells): iterable;
}

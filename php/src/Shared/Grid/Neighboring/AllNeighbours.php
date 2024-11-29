<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Neighboring;

use Advent\Shared\Grid\GridCell;
use Advent\Shared\Grid\GridCells;
use Advent\Shared\Grid\Neighbours;

final readonly class AllNeighbours implements Neighbours
{
    public function for(GridCell $cell, GridCells $cells): iterable
    {
        return [
            ...(new OrthogonalNeighbors())->for($cell, $cells),
            ...(new NonOrthogonalNeighbors())->for($cell, $cells),
        ];
    }
}

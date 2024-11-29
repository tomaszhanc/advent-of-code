<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Neighboring;

use Advent\Shared\Grid\Direction;
use Advent\Shared\Grid\GridCell;
use Advent\Shared\Grid\GridCells;
use Advent\Shared\Grid\Neighbours;

final readonly class NonOrthogonalNeighbors implements Neighbours
{
    public function for(GridCell $cell, GridCells $cells): iterable
    {
        return array_filter([
            $cells->findAt($cell->location()->neighbourAt(Direction::UP_LEFT)),
            $cells->findAt($cell->location()->neighbourAt(Direction::UP_RIGHT)),
            $cells->findAt($cell->location()->neighbourAt(Direction::DOWN_LEFT)),
            $cells->findAt($cell->location()->neighbourAt(Direction::DOWN_RIGHT)),
        ]);
    }
}

<?php

declare(strict_types=1);

namespace Advent\Year2023\Day10\Model\Grid;

use Advent\Shared\Grid\GridCell;
use Advent\Shared\Grid\GridCells;
use Advent\Shared\Grid\Neighbours;

final readonly class OnlyValidPipeConnections implements Neighbours
{
    /**
     * @param GridCellPipeAdapter $cell
     * @param GridCells<GridCellPipeAdapter> $cells
     */
    public function for(GridCell $cell, GridCells $cells): iterable
    {
        $pipe = $cell->pipe;

        foreach ($pipe->directions() as $direction) {
            $neighbourLocation = $pipe->location()->neighbourAt($direction);

            if (!$cells->hasAt($neighbourLocation)) {
                continue;
            }

            $neighbour = $cells->getAt($neighbourLocation);

            if ($neighbour->pipe->in($direction->opposite())) {
                yield $neighbour;
            }
        }
    }
}

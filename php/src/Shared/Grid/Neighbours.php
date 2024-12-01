<?php

declare(strict_types=1);

namespace Advent\Shared\Grid;

final class Neighbours
{
    /** @return GridCell[] */
    public function for(GridCell $cell, GridCells $cells): array
    {
        $neighbours = [];

        foreach ($cell->possibleDirections() as $direction) {
            $neighbourLocation = $cell->location()->neighbourAt($direction);

            if (!$cells->hasAt($neighbourLocation)) {
                continue;
            }

            $neighbour = $cells->getAt($neighbourLocation);

            if ($neighbour->canMoveTo($direction->opposite())) {
                $neighbours[] = $neighbour;
            }
        }

        return $neighbours;
    }
}

<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\GraphBridge;

use Advent\Shared\Graph\Edge;
use Advent\Shared\Graph\Graph;
use Advent\Shared\Grid\Grid;

final readonly class GridToGraphFactory
{
    public function createGraph(Grid $grid): Graph
    {
        $edges = [];

        foreach ($grid->allCells() as $cell) {
            foreach ($cell->possibleDirections() as $direction) {
                $neighbourLocation = $cell->location()->neighbourAt($direction);

                if (!$grid->hasCellAt($neighbourLocation)) {
                    continue;
                }

                $neighbour = $grid->getCellAt($neighbourLocation);

                if ($neighbour->canMoveTo($direction->opposite())) {
                    $edges[] = new Edge(
                        new GridCellNode($cell),
                        new GridCellNode($neighbour),
                        1
                    );
                }
            }
        }

        return new Graph(...$edges);
    }
}

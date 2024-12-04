<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\GraphBridge;

use Advent\Shared\Graph\Edge;
use Advent\Shared\Graph\Graph;
use Advent\Shared\Grid\Grid;

final readonly class GridToGraphFactory
{
    public function __construct(
        private AllowedDirections $allowedDirections
    ) {
    }

    public function createGraph(Grid $grid): Graph
    {
        $edges = [];

        foreach ($grid->allCells() as $cell) {
            foreach ($this->allowedDirections->for($cell) as $direction) {
                $neighbourLocation = $cell->location()->neighbourAt($direction);

                if (!$grid->hasCellAt($neighbourLocation)) {
                    continue;
                }

                $neighbour = $grid->getCellAt($neighbourLocation);
                $neighbourDirections = $this->allowedDirections->for($neighbour);

                if ($neighbourDirections->has($direction->opposite())) {
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

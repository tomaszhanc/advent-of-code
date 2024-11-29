<?php

declare(strict_types=1);

namespace Advent\Year2023\Day10\Model;

use Advent\Shared\Grid\GridCell;
use Advent\Shared\Grid\GridCells;
use Advent\Shared\Grid\Search\BreadthFirstSearch;
use Advent\Shared\Grid\Search\ResultEvaluator\FarthestPointEvaluator;
use Advent\Year2023\Day10\Model\Grid\OnlyValidPipeConnections;

final readonly class PipeDiagram
{
    public function __construct(
        private GridCell $startingPoint,
        private GridCells $cells,
    ) {
    }

    public function stepsToFarthestPoint(): int
    {
        return (new BreadthFirstSearch(
            new FarthestPointEvaluator(),
            new OnlyValidPipeConnections()
        ))->search($this->startingPoint, $this->cells)
          ->distance();
    }
}

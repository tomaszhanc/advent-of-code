<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Search;

use Advent\Shared\Grid\GridCell;
use Advent\Shared\Grid\GridCells;
use Advent\Shared\Grid\Neighbours;

final readonly class DeepFirstSearch
{
    private Neighbours $neighbours;
    private ResultEvaluator $resultEvaluator;

    public function __construct(ResultEvaluator $resultEvaluator)
    {
        $this->neighbours = new Neighbours();
        $this->resultEvaluator = $resultEvaluator;
    }

    public function search(GridCell $startingCell, GridCells $allCells): SearchResult
    {
        $stack = new Stack();
        $stack->push($start = Path::startFrom($startingCell));

        $longestPath = $start;

        while (!$stack->isEmpty()) {
            $currentPath = $stack->pop();
            $currentNeighbours = $this->neighbours->for($currentPath->lastCell(), $allCells);
            $longestPath = $this->resultEvaluator->evaluate($longestPath, $currentPath);

            foreach ($currentNeighbours as $neighbour) {
                if ($currentPath->has($neighbour)) {
                    continue;
                }

                $stack->push($currentPath->addStep($neighbour, 1));
            }
        }

        return new SearchResult($longestPath);
    }
}

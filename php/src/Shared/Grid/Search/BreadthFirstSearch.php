<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Search;

use Advent\Shared\Grid\GridCell;
use Advent\Shared\Grid\GridCells;
use Advent\Shared\Grid\Neighbours;

final readonly class BreadthFirstSearch
{
    public function __construct(
        private ResultEvaluator $resultEvaluator,
    ) {
    }

    public function search(GridCell $startingCell, GridCells $allCells): SearchResult
    {
        $queue = new Queue();
        $visitorLog = new VisitorLog();
        $neighbours = new Neighbours();
        $currentResult = new SearchResult($startingCell, 0);

        $queue->enqueue($currentResult);
        $visitorLog->markAsVisited($startingCell);

        while (!$queue->isEmpty()) {
            $nextResult = $queue->dequeue();

            if ($this->resultEvaluator->evaluate($currentResult, $nextResult)) {
                $currentResult = $nextResult;
            }

            foreach ($neighbours->for($nextResult->cell(), $allCells) as $neighbour) {
                if ($visitorLog->isVisited($neighbour)) {
                    continue;
                }

                // fixme each neighbour should have a distance?
                $queue->enqueue(new SearchResult($neighbour, $nextResult->distance() + 1));
                $visitorLog->markAsVisited($neighbour);
            }
        }

        return $currentResult;
    }
}

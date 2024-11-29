<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Search;

use Advent\Shared\Grid\GridCell;
use Advent\Shared\Grid\GridCells;
use Advent\Shared\Grid\Neighboring\AllNeighbours;
use Advent\Shared\Grid\Neighbours;

final readonly class BreadthFirstSearch
{
    public function __construct(
        private ResultEvaluator $resultEvaluator,
        private Neighbours $neighbours = new AllNeighbours()
    ) {
    }

    public function search(GridCell $startingCell, GridCells $gridCells): SearchResult
    {
        $queue = new Queue();
        $visitorLog = new VisitorLog();
        $currentResult = new SearchResult($startingCell, 0);

        $queue->enqueue($currentResult);
        $visitorLog->markAsVisited($startingCell);

        while (!$queue->isEmpty()) {
            $nextResult = $queue->dequeue(); // fixme SearchResult to chyba zla nazwa

            if ($this->resultEvaluator->evaluate($currentResult, $nextResult)) {
                $currentResult = $nextResult;
            }

            foreach ($this->neighbours->for($nextResult->cell(), $gridCells) as $neighbour) {
                if ($visitorLog->isVisited($neighbour)) {
                    continue;
                }

                $queue->enqueue(new SearchResult($neighbour, $nextResult->distance() + 1));
                $visitorLog->markAsVisited($neighbour);
            }
        }

        return $currentResult;
    }
}

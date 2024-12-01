<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Search;

use Advent\Shared\Grid\GridCell;
use Advent\Shared\Grid\GridCells;
use Advent\Shared\Grid\Neighbours;

final readonly class BreadthFirstSearch
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
        $visitorLog = new VisitorLog();
        $visitorLog->markAsVisited($startingCell); // fixme global vs path?

        $queue = new Queue();
        $queue->enqueue($start = Path::startFrom($startingCell));

        $resultPath = $start;

        while (!$queue->isEmpty()) {
            $currentPath = $queue->dequeue();

            // if v is the goal then return v

            //
            //
            $currentNeighbours = $this->neighbours->for($currentPath->lastCell(), $allCells);


            //
            //             // fixme to powinien być ResultEvaluator i jakos polaczony z tym iffem nizej
            //            // coolect SubResult, PartialResult?
            //            // to znaczy ze skonczyl się ścieżka i można zrobić wyliczenia
            //            if (count($currentNeighbours) === 0) {
            //                // fixme tutaj nigdy nie dojdzie, to powinno być unvisitedNeihbours
            //                $resultPath[] = $currentPath; // fixme COLLECTOR?
            //            }

            $resultPath = $this->resultEvaluator->evaluate($resultPath, $currentPath);

            foreach ($currentNeighbours as $neighbour) {
                // fixme vistorLog moze byc globalny albo na path, jak to ma dzialac?
                if ($visitorLog->isVisited($neighbour)) {
                    continue;
                }

                $visitorLog->markAsVisited($neighbour);
                $queue->enqueue($currentPath->addStep($neighbour, 1));
            }
        }

        return new SearchResult($resultPath);
    }
}

<?php

declare(strict_types=1);

namespace Advent\Shared\Graph\Search;

use Advent\Shared\Graph\Graph;
use Advent\Shared\Graph\Node;

final readonly class BreadthFirstSearch
{
    private ResultEvaluator $resultEvaluator;

    public function __construct(ResultEvaluator $resultEvaluator)
    {
        $this->resultEvaluator = $resultEvaluator;
    }

    public function search(Node $startingNode, Graph $graph): SearchResult
    {
        $resultPath = Path::startFrom($startingNode);

        $queue = new Queue();
        $visitorLog = new VisitorLog();

        $visitorLog->markAsVisited($startingNode);
        $queue->enqueue($resultPath);

        while (!$queue->isEmpty()) {
            $currentPath = $queue->dequeue();
            $currentNeighbours = $graph->neighboursFor($currentPath->lastNode());
            $resultPath = $this->resultEvaluator->evaluate($resultPath, $currentPath);

            //
            //             // fixme to powinien być ResultEvaluator i jakos polaczony z tym iffem nizej
            //            // coolect SubResult, PartialResult?
            //            // to znaczy ze skonczyl się ścieżka i można zrobić wyliczenia
            //            if (count($currentNeighbours) === 0) {
            //                // fixme tutaj nigdy nie dojdzie, to powinno być unvisitedNeihbours
            //                $resultPath[] = $currentPath; // fixme COLLECTOR?
            //            }

            foreach ($currentNeighbours as $neighbour) {
                if ($visitorLog->isVisited($neighbour->node)) {
                    continue;
                }

                $visitorLog->markAsVisited($neighbour->node);
                $queue->enqueue($currentPath->addStep($neighbour->node, $neighbour->weight));
            }
        }

        return new SearchResult($resultPath);
    }
}

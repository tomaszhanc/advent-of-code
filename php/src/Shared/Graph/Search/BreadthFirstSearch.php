<?php

declare(strict_types=1);

namespace Advent\Shared\Graph\Search;

use Advent\Shared\Graph\Graph;
use Advent\Shared\Graph\Node;

final readonly class BreadthFirstSearch
{
    public function search(Node $startingNode, Graph $graph, ResultEvaluator $resultEvaluator): ?SearchResult
    {
        $resultPath = Path::startFrom($startingNode);

        $queue = new Queue();
        $queue->enqueue($resultPath);

        $visitorLog = new VisitorLog();
        $visitorLog->markAsVisited($startingNode);

        while (!$queue->isEmpty()) {
            $currentPath = $queue->dequeue();
            $currentNeighbours = $graph->neighboursFor($currentPath->lastNode());
            $resultPath = $resultEvaluator->evaluate($resultPath, $currentPath);

            if ($resultEvaluator->searchCompleted($resultPath)) {
                break;
            }

            foreach ($currentNeighbours as $neighbour) {
                if ($visitorLog->isVisited($neighbour->node)) {
                    continue;
                }

                $queue->enqueue($currentPath->addStep($neighbour->node, $neighbour->weight));
                $visitorLog->markAsVisited($neighbour->node);
            }
        }

        return $resultEvaluator->validResult($resultPath) ? new SearchResult($resultPath) : null;
    }
}

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
        $queue->enqueue($resultPath);

        $visitorLog = new VisitorLog();
        $visitorLog->markAsVisited($startingNode);

        while (!$queue->isEmpty()) {
            $currentPath = $queue->dequeue();
            $currentNeighbours = $graph->neighboursFor($currentPath->lastNode());

            $resultPath = $this->resultEvaluator->evaluate($resultPath, $currentPath);

            foreach ($currentNeighbours as $neighbour) {
                if ($visitorLog->isVisited($neighbour->node)) {
                    continue;
                }

                $queue->enqueue($currentPath->addStep($neighbour->node, $neighbour->weight));
                $visitorLog->markAsVisited($neighbour->node);
            }
        }

        return new SearchResult($resultPath);
    }
}

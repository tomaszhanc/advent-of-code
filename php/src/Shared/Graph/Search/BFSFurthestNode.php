<?php

declare(strict_types=1);

namespace Advent\Shared\Graph\Search;

use Advent\Shared\Graph\Graph;
use Advent\Shared\Graph\NodeId;
use SplQueue;

final readonly class BFSFurthestNode
{
    public function __construct(
        private Graph $graph
    ) {
    }

    public function searchFrom(NodeId $startNodeId): SearchResult
    {
        /** @var SplQueue<SearchResult> $queue */
        $queue = new SplQueue();
        $visitorLog = new VisitorLog();
        $startNode = $this->graph->get($startNodeId);
        $furthestNodeResult = new SearchResult($startNode, 0);

        $queue->enqueue($furthestNodeResult);
        $visitorLog->markNodeAsVisited($startNode);

        while (!$queue->isEmpty()) {
            $currentNodeResult = $queue->dequeue();

            if ($currentNodeResult->distance() > $furthestNodeResult->distance()) {
                $furthestNodeResult = $currentNodeResult;
            }

            foreach ($currentNodeResult->neighbours() as $neighbour) {
                if ($visitorLog->isVisited($neighbour)) {
                    continue;
                }

                $queue->enqueue($currentNodeResult->next($neighbour));
                $visitorLog->markNodeAsVisited($neighbour);
            }
        }

        return $furthestNodeResult;
    }
}

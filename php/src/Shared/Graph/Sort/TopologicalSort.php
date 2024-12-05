<?php

declare(strict_types=1);

namespace Advent\Shared\Graph\Sort;

use Advent\Shared\Graph\Graph;
use Advent\Shared\Graph\Node;
use Advent\Shared\RuntimeException;

final readonly class TopologicalSort
{
    /** @return Node[] */
    public function sortNodes(Graph $graph): array
    {
        $inDegrees = $graph->inDegrees();

        $queue = new Queue();
        foreach ($graph->nodesWithoutIncomingEdges() as $node) {
            $queue->enqueue($node);
        }

        $sorted = [];
        while (!$queue->isEmpty()) {
            $currentNode = $queue->dequeue();
            $sorted[] = $currentNode;

            foreach ($graph->neighboursFor($currentNode) as $neighbour) {
                $neighborNodeId = $neighbour->node->id();
                $inDegrees[$neighborNodeId]--;

                if ($inDegrees[$neighborNodeId] === 0) {
                    $queue->enqueue($graph->getNode($neighborNodeId));
                }
            }
        }

        if (count($sorted) !== $graph->nodeCount()) {
            throw new RuntimeException("Topological sort is not possible for graph with cycles");
        }

        return $sorted;
    }
}

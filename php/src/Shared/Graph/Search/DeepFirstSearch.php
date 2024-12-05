<?php

declare(strict_types=1);

namespace Advent\Shared\Graph\Search;

use Advent\Shared\Graph\Graph;
use Advent\Shared\Graph\Node;

final readonly class DeepFirstSearch
{
    public function search(Node $startingNode, Graph $graph, ResultEvaluator $resultEvaluator): ?SearchResult
    {
        $resultPath = Path::startFrom($startingNode);

        $stack = new Stack();
        $stack->push($resultPath);

        while (!$stack->isEmpty()) {
            $currentPath = $stack->pop();
            $currentNeighbours = $graph->neighboursFor($currentPath->lastNode());
            $resultPath = $resultEvaluator->evaluate($resultPath, $currentPath);

            if ($resultEvaluator->searchCompleted($resultPath)) {
                break;
            }

            foreach ($currentNeighbours as $neighbour) {
                if ($currentPath->contains($neighbour->node)) {
                    continue;
                }

                $stack->push($currentPath->addStep($neighbour->node, $neighbour->weight));
            }
        }

        return $resultEvaluator->validResult($resultPath) ? new SearchResult($resultPath) : null;
    }
}

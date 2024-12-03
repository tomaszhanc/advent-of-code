<?php

declare(strict_types=1);

namespace Advent\Shared\Graph\Search;

use Advent\Shared\Graph\Graph;
use Advent\Shared\Graph\Node;

final readonly class DeepFirstSearch
{
    private ResultEvaluator $resultEvaluator;

    public function __construct(ResultEvaluator $resultEvaluator)
    {
        $this->resultEvaluator = $resultEvaluator;
    }

    public function search(Node $startingNode, Graph $graph): SearchResult
    {
        $longestPath = Path::startFrom($startingNode);

        $stack = new Stack();
        $stack->push($longestPath);

        while (!$stack->isEmpty()) {
            $currentPath = $stack->pop();
            $currentNeighbours = $graph->neighboursFor($currentPath->lastNode());
            $longestPath = $this->resultEvaluator->evaluate($longestPath, $currentPath);

            foreach ($currentNeighbours as $neighbour) {
                if ($currentPath->contains($neighbour->node)) {
                    continue;
                }

                $stack->push($currentPath->addStep($neighbour->node, $neighbour->weight));
            }
        }

        return new SearchResult($longestPath);
    }
}

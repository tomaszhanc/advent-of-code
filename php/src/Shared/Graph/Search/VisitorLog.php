<?php

declare(strict_types=1);

namespace Advent\Shared\Graph\Search;

use Advent\Shared\Graph\Neighbour;
use Advent\Shared\Graph\Node;

final class VisitorLog
{
    private array $visited = [];

    public function markNodeAsVisited(Node|Neighbour $node): void
    {
        if ($node instanceof Neighbour) {
            $node = $node->node;
        }

        $this->visited[$node->nodeId()->toString()] = true;
    }

    public function isVisited(Node|Neighbour $node): bool
    {
        if ($node instanceof Neighbour) {
            $node = $node->node;
        }

        return $this->visited[$node->nodeId()->toString()] ?? false;
    }
}

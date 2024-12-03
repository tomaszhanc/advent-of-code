<?php

declare(strict_types=1);

namespace Advent\Shared\Graph\Search;

use Advent\Shared\Graph\Node;

final class VisitorLog
{
    private array $visited = [];

    public function markAsVisited(Node $node): void
    {
        $this->visited[$node->id()] = true;
    }

    public function isVisited(Node $node): bool
    {
        return $this->visited[$node->id()] ?? false;
    }
}

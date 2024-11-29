<?php

declare(strict_types=1);

namespace Advent\Shared\Graph\Search;

use Advent\Shared\Graph\Neighbour;
use Advent\Shared\Graph\Node;
use Advent\Shared\Graph\NodeId;

final readonly class SearchResult
{
    public function __construct(
        private Node $node,
        private int $distance
    ) {
    }

    public function nodeId(): NodeId
    {
        return $this->node instanceof Node
            ? $this->node->nodeId()
            : $this->node->node->nodeId();
    }

    /** @return Neighbour[] */
    public function neighbours(): array
    {
        return $this->node->neighbours();
    }

    public function distance(): int
    {
        return $this->distance;
    }

    public function next(Neighbour $neighbour): self
    {
        return new self(
            $neighbour->node,
            $this->distance + $neighbour->weight
        );
    }
}

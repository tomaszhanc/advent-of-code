<?php

declare(strict_types=1);

namespace Advent\Shared\Graph;

final class GraphBuilder
{
    /** @var Node[] */
    private array $nodes = [];

    public function addLinkBetween(NodeId $a, NodeId $b, int $weight = 1): void
    {
        $nodeA = $this->getOrCreateNode($a);
        $nodeB = $this->getOrCreateNode($b);

        $nodeA->addLinkTo($nodeB, $weight);
        $nodeB->addLinkTo($nodeA, $weight);
    }

    public function build(): Graph
    {
        return new Graph(...$this->nodes);
    }

    private function getOrCreateNode(NodeId $nodeId): Node
    {
        if (!isset($this->nodes[$nodeId->toString()])) {
            $this->nodes[$nodeId->toString()] = new Node($nodeId);
        }

        return $this->nodes[$nodeId->toString()];
    }
}

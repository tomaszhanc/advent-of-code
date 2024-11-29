<?php

declare(strict_types=1);

namespace Advent\Shared\Graph;

final class Node
{
    /** @var Neighbour[] */
    private array $neighbours;

    public function __construct(private readonly NodeId $id)
    {
    }

    public function nodeId(): NodeId
    {
        return $this->id;
    }

    public function addLinkTo(Node $node, int $weight = 1): void
    {
        $this->neighbours[] = new Neighbour($node, $weight);
    }

    /** @return Neighbour[] */
    public function neighbours(): array
    {
        return $this->neighbours;
    }

    /** @return Node[] */
    public function neighbourNodes(): array
    {
        return array_map(fn (Neighbour $neighbour) => $neighbour->node, $this->neighbours);
    }
}

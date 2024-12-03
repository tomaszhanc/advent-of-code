<?php

declare(strict_types=1);

namespace Advent\Shared\Graph;

final readonly class Graph
{
    /** @var array<string, Node> */
    private array $nodes;

    /** @var array<string, Neighbour[]> */
    private array $neighbours;

    public function __construct(Edge ...$edges)
    {
        $nodes = [];
        $neighbours = [];

        foreach ($edges as $edge) {
            $nodes[$edge->from->id()] = $edge->from;
            $nodes[$edge->to->id()] = $edge->to;

            $neighbours[$edge->from->id()][] = new Neighbour($edge->to, $edge->weight);
            $neighbours[$edge->to->id()][] = new Neighbour($edge->from, $edge->weight);
        }

        $this->nodes = $nodes;
        $this->neighbours = $neighbours;
    }

    /** @return Neighbour[] */
    public function neighboursFor(Node $node): array
    {
        return $this->neighbours[$node->id()] ?? [];
    }
}

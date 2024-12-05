<?php

declare(strict_types=1);

namespace Advent\Shared\Graph;

use Advent\Shared\RuntimeException;

final readonly class Graph
{
    /** @var array<string, Node> */
    private array $nodes;

    /**
     * Nodes of outgoing edges for each node
     *
     * @var array<string, Neighbour[]>
     */
    private array $neighbours;

    /**
     * Number of incoming edges for each node
     *
     * @var array<string, int>
     */
    private array $inDegrees;

    public function __construct(Edge ...$edges)
    {
        $nodes = [];
        $neighbours = [];
        $inDegrees = [];

        foreach ($edges as $edge) {
            $nodes[$edge->from->id()] = $edge->from;
            $nodes[$edge->to->id()] = $edge->to;
            $inDegrees[$edge->from->id()] ??= 0;
            $inDegrees[$edge->to->id()] ??= 0;


            $neighbours[$edge->from->id()][] = new Neighbour($edge->to, $edge->weight);
            $inDegrees[$edge->to->id()]++;

            if ($edge->directed === false) {
                $neighbours[$edge->to->id()][] = new Neighbour($edge->from, $edge->weight);
                $inDegrees[$edge->from->id()]++;
            }
        }

        $this->nodes = $nodes;
        $this->neighbours = $neighbours;
        $this->inDegrees = $inDegrees;
    }

    /** @return Node[] */
    public function nodes(): array
    {
        return array_values($this->nodes);
    }

    public function getNode(string $nodeId): Node
    {
        return $this->nodes[$nodeId] ?? throw new RuntimeException("Node with id $nodeId does not exist");
    }

    public function nodeCount(): int
    {
        return count($this->nodes);
    }

    /** @return Neighbour[] */
    public function neighboursFor(Node $node): array
    {
        return $this->neighbours[$node->id()] ?? [];
    }

    /** @return array<string, int> */
    public function inDegrees(): array
    {
        return $this->inDegrees;
    }

    /** @return Node[] */
    public function nodesWithoutIncomingEdges(): iterable
    {
        foreach ($this->inDegrees as $nodeId => $inDegree) {
            if ($inDegree === 0) {
                yield $this->nodes[$nodeId];
            }
        }
    }
}

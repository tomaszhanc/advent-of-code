<?php

declare(strict_types=1);

namespace Advent\Shared\Graph;

use Advent\Shared\InvalidArgumentException;

final readonly class Graph
{
    /** @var Node[] */
    private array $nodes;

    public function __construct(Node ...$nodes)
    {
        $this->nodes = $nodes;
    }

    public function get(NodeId $nodeId): Node
    {
        return $this->nodes[$nodeId->toString()]
            ?? throw InvalidArgumentException::because('Node with id "%s" not found', $nodeId->toString());
    }

    public function exists(NodeId $nodeId): bool
    {
        return isset($this->nodes[$nodeId->toString()]);
    }
}

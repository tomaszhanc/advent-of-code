<?php

declare(strict_types=1);

namespace Advent\Year2023\Day8\Model;

use Advent\Shared\RuntimeException;

final class Nodes
{
    /** @var Node[] */
    private array $nodes;

    public function __construct(Node ...$nodes)
    {
        $this->nodes = array_combine(
            array_map(fn (Node $node): string => $node->name, $nodes),
            $nodes
        );
    }

    public function get(string $name): Node
    {
        return $this->nodes[$name] ?? throw RuntimeException::because('Node %s does not exist', $name);
    }

    /**
     * @param callable(Node) : bool $filter
     * @return Node[]
     */
    public function filter(callable $filter): array
    {
        return array_values(array_filter($this->nodes, $filter));
    }
}

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

    public function startNode(): Node
    {
        return $this->nodes['AAA'] ?? throw RuntimeException::because('Starting node does not exist');
    }

    public function moveFrom(Node $from, Direction $step): Node
    {
        if ($step === Direction::LEFT) {
            return $this->nodes[$from->leftNodeName];
        }

        return $this->nodes[$from->rightNodeName];
    }
}

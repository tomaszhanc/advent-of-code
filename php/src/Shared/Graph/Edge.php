<?php

declare(strict_types=1);

namespace Advent\Shared\Graph;

use Advent\Shared\InvalidArgumentException;

final readonly class Edge
{
    private function __construct(
        public NodeId $from,
        public NodeId $to,
        public int $weight,
        public bool $directed
    ) {
        if ($weight < 0) {
            throw InvalidArgumentException::because('Weight must be a positive integer, %d given', $weight);
        }

        if ($from === $to) {
            throw InvalidArgumentException::because('Nodes must be different');
        }
    }

    public static function directed(NodeId $from, NodeId $to, int $weight): Edge
    {
        return new Edge($from, $to, $weight, directed: true);
    }

    public static function undirected(NodeId $from, NodeId $to, int $weight): Edge
    {
        return new Edge($from, $to, $weight, directed: false);
    }
}

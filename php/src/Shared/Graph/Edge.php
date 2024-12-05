<?php

declare(strict_types=1);

namespace Advent\Shared\Graph;

use Advent\Shared\InvalidArgumentException;

final readonly class Edge
{
    public function __construct(
        public Node $from,
        public Node $to,
        public int $weight,
        public bool $directed
    ) {
        if ($weight < 0) {
            throw InvalidArgumentException::because('Weight must be greater than 0, %d given', $weight);
        }

        if ($from === $to) {
            throw InvalidArgumentException::because('Nodes must be different');
        }
    }

    public static function undirected(Node $from, Node $to, int $weight): self
    {
        return new self($from, $to, $weight, directed: false);
    }

    public static function directed(Node $from, Node $to, int $weight): self
    {
        return new self($from, $to, $weight, directed: true);
    }
}

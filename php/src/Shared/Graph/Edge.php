<?php

declare(strict_types=1);

namespace Advent\Shared\Graph;

use Advent\Shared\InvalidArgumentException;

final readonly class Edge
{
    public function __construct(
        public Node $from,
        public Node $to,
        public int $weight
    ) {
        if ($weight < 0) {
            throw InvalidArgumentException::because('Weight must be greater than 0, %d given', $weight);
        }

        if ($from === $to) {
            throw InvalidArgumentException::because('Nodes must be different');
        }
    }
}

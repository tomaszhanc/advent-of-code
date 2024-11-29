<?php

declare(strict_types=1);

namespace Advent\Shared\Graph;

final readonly class Neighbour
{
    public function __construct(
        public Node $node,
        public int $weight
    ) {
    }
}

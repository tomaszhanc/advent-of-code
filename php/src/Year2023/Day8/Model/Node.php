<?php

declare(strict_types=1);

namespace Advent\Year2023\Day8\Model;

final readonly class Node
{
    public function __construct(
        public string $name,
        public string $leftNodeName,
        public string $rightNodeName
    ) {
    }

    public function isFinalDestination(): bool
    {
        return $this->name === 'ZZZ';
    }
}

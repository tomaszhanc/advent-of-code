<?php

declare(strict_types=1);

namespace Advent\Year2023\Day8\Model;

final readonly class Node
{
    public function __construct(
        public string $name,
        private string $leftNodeName,
        private string $rightNodeName
    ) {
    }

    public function move(Direction $direction, Nodes $nodes): self
    {
        if ($direction === Direction::LEFT) {
            return $nodes->get($this->leftNodeName);
        }

        return $nodes->get($this->rightNodeName);
    }

    public function is(string $nodeName): bool
    {
        return $this->name === $nodeName;
    }

    public function endsWithA(): bool
    {
        return str_ends_with($this->name, 'A');
    }

    public function endsWithZ(): bool
    {
        return str_ends_with($this->name, 'Z');
    }
}

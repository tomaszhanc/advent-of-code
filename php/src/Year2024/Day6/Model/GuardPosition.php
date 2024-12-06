<?php

declare(strict_types=1);

namespace Advent\Year2024\Day6\Model;

final readonly class GuardPosition
{
    public function __construct(
        public Position $position,
        public Direction $direction
    ) {
    }

    public function rotateRight(): self
    {
        return new self(
            $this->position,
            $this->direction->rotateRight()
        );
    }
}

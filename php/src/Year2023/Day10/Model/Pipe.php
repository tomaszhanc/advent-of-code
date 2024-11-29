<?php

declare(strict_types=1);

namespace Advent\Year2023\Day10\Model;

use Advent\Shared\Grid\Location;
use Advent\Shared\Grid\Direction;

final readonly class Pipe
{
    public function __construct(
        private int $lineNumber,
        private int $position,
        private PipeType $type
    ) {
    }

    public function location(): Location
    {
        return new Location($this->position, $this->lineNumber);
    }

    public function in(Direction $direction): bool
    {
        return $this->type->in($direction);
    }

    public function isStartingPoint(): bool
    {
        return $this->type === PipeType::START;
    }

    /** @return Direction[] */
    public function directions(): array
    {
        return $this->type->directions();
    }
}

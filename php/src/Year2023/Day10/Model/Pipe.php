<?php

declare(strict_types=1);

namespace Advent\Year2023\Day10\Model;

use Advent\Shared\Grid\GridCell;
use Advent\Shared\Grid\Location;
use Advent\Shared\Grid\Direction;

final readonly class Pipe implements GridCell
{
    public function __construct(
        private int $lineNumber,
        private int $position,
        public PipeType $type
    ) {
    }

    public function location(): Location
    {
        return new Location($this->position, $this->lineNumber);
    }

    public function isStartingPoint(): bool
    {
        return $this->type === PipeType::START;
    }

    public function canMoveTo(Direction $direction): bool
    {
        return $this->type->isIn($direction);
    }

    /** @return Direction[] */
    public function possibleDirections(): array
    {
        return $this->type->accessibleDirections();
    }
}

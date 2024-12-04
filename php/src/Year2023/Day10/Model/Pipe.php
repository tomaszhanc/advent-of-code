<?php

declare(strict_types=1);

namespace Advent\Year2023\Day10\Model;

use Advent\Shared\Grid\Cell;
use Advent\Shared\Grid\Location;

final readonly class Pipe implements Cell
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
}

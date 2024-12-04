<?php

declare(strict_types=1);

namespace Advent\Year2024\Day4\Model;

use Advent\Shared\Grid\Cell;
use Advent\Shared\Grid\Direction;
use Advent\Shared\Grid\Location;

final readonly class Square implements Cell
{
    public function __construct(
        private Location $location,
        public string $value
    ) {
    }

    public function location(): Location
    {
        return $this->location;
    }

    public function possibleDirections(): array
    {

    }

    public function canMoveTo(Direction $direction): bool
    {

    }
}

<?php

declare(strict_types=1);

namespace Advent\Year2024\Day6\Model;

use Advent\Shared\Grid\Cell;
use Advent\Shared\Grid\Location;

final class Position implements Cell
{
    public function __construct(
        private readonly Location $location,
        private readonly string $value
    ) {
    }

    public function location(): Location
    {
        return $this->location;
    }

    public function value(): string|\Stringable
    {
        return $this->value;
    }

    public function isObstacle(): bool
    {
        return $this->value === '#';
    }
}

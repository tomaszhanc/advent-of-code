<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Pattern;

use Advent\Shared\Grid\Cell;
use Advent\Shared\Grid\Location;

final readonly class SubGridCell implements Cell
{
    public function __construct(
        private Cell $cell,
        private Location $location
    ) {
    }

    public function location(): Location
    {
        return $this->location;
    }

    public function value(): string|\Stringable
    {
        return $this->cell->value();
    }
}

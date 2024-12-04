<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Cell;

use Advent\Shared\Grid\Cell;
use Advent\Shared\Grid\Location;

final readonly class SubGridCell implements Cell
{
    public function __construct(
        private int $x,
        private int $y,
        private Cell $cell
    ) {
    }

    public function location(): Location
    {
        return new Location($this->x, $this->y);
    }

    public function value(): string|\Stringable
    {
        return $this->cell->value();
    }
}

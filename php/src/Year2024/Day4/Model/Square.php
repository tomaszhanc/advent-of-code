<?php

declare(strict_types=1);

namespace Advent\Year2024\Day4\Model;

use Advent\Shared\Grid\Cell;
use Advent\Shared\Grid\Location;

final readonly class Square implements Cell
{
    public function __construct(
        private int $x,
        private int $y,
        public string $letter
    ) {
    }

    public function location(): Location
    {
        return new Location($this->x, $this->y);
    }

    public function value(): string
    {
        return $this->letter;
    }
}

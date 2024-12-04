<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Cell;

use Advent\Shared\Grid\Cell;
use Advent\Shared\Grid\Location;

final readonly class StringCell implements Cell
{
    public function __construct(
        private Location $location,
        private string $value
    ) {
    }

    public static function create(int $x, int $y, string $value): self
    {
        return new self(new Location($x, $y), $value);
    }

    public function location(): Location
    {
        return $this->location;
    }

    public function value(): string|\Stringable
    {
        return $this->value;
    }
}

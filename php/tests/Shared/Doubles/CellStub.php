<?php

declare(strict_types=1);

namespace Advent\Tests\Shared\Doubles;

use Advent\Shared\Grid\Cell;
use Advent\Shared\Grid\CellTraits\AllDirections;
use Advent\Shared\Grid\Location;

final readonly class CellStub implements Cell
{
    use AllDirections;

    public function __construct(
        private readonly Location $location
    ) {
    }

    public static function create(int $x, int $y): self
    {
        return new self(new Location($x, $y));
    }

    public function location(): Location
    {
        return $this->location;
    }
}

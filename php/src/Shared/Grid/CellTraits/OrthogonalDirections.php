<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\CellTraits;

use Advent\Shared\Grid\Direction;

trait OrthogonalDirections
{
    use CanMoveToPossibleDirections;

    public function possibleDirections(): array
    {
        return [
            Direction::UP,
            Direction::DOWN,
            Direction::LEFT,
            Direction::RIGHT,
        ];
    }
}

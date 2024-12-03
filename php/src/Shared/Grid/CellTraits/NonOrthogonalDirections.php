<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\CellTraits;

use Advent\Shared\Grid\Direction;

trait NonOrthogonalDirections
{
    use CanMoveToPossibleDirections;

    public function possibleDirections(): array
    {
        return [
            Direction::UP_LEFT,
            Direction::UP_RIGHT,
            Direction::DOWN_RIGHT,
            Direction::DOWN_LEFT,
        ];
    }
}

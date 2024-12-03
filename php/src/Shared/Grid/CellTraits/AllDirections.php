<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\CellTraits;

use Advent\Shared\Grid\Direction;

trait AllDirections
{
    use CanMoveToPossibleDirections;

    public function possibleDirections(): array
    {
        return [
            Direction::UP_LEFT,
            Direction::UP,
            Direction::UP_RIGHT,
            Direction::RIGHT,
            Direction::DOWN_RIGHT,
            Direction::DOWN,
            Direction::DOWN_LEFT,
            Direction::LEFT,
        ];
    }
}

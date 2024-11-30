<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Traits;

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

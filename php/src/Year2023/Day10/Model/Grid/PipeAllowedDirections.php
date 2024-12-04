<?php

declare(strict_types=1);

namespace Advent\Year2023\Day10\Model\Grid;

use Advent\Shared\Grid\Cell;
use Advent\Shared\Grid\Directions;
use Advent\Shared\Grid\GraphBridge\AllowedDirections;
use Advent\Shared\InvalidArgumentException;
use Advent\Year2023\Day10\Model\Pipe;

final readonly class PipeAllowedDirections implements AllowedDirections
{
    public function for(Cell $pipe): Directions
    {
        if (!$pipe instanceof Pipe) {
            throw new InvalidArgumentException('Only Pipes are supported');
        }

        return $pipe->type->accessibleDirections();
    }
}

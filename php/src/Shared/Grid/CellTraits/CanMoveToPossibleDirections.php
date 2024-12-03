<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\CellTraits;

use Advent\Shared\Grid\Direction;

/**
 * Implements allowsFrom method for GridCell using accessibleDirections method.
 * In some cases it's better to implement allowsFrom method alone using a bitwise operations.
 */
trait CanMoveToPossibleDirections
{
    public function canMoveTo(Direction $direction): bool
    {
        foreach ($this->possibleDirections() as $next) {
            if ($next->equals($direction)) {
                return true;
            }
        }

        return false;
    }

    /** @return Direction[] */
    abstract public function possibleDirections(): array;
}

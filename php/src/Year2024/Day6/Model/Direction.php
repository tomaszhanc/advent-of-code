<?php

declare(strict_types=1);

namespace Advent\Year2024\Day6\Model;

use Advent\Shared\Grid\Direction as GridDirection;

enum Direction: string
{
    case UP = '^';
    case RIGHT = '>';
    case DOWN = 'v';
    case LEFT = '<';

    public function toGridDirection(): GridDirection
    {
        return match ($this) {
            self::UP => GridDirection::UP,
            self::RIGHT => GridDirection::RIGHT,
            self::DOWN => GridDirection::DOWN,
            self::LEFT => GridDirection::LEFT,
        };
    }

    public function rotateRight(): self
    {
        return match ($this) {
            self::UP => self::RIGHT,
            self::RIGHT => self::DOWN,
            self::DOWN => self::LEFT,
            self::LEFT => self::UP,
        };
    }
}

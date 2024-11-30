<?php

declare(strict_types=1);

namespace Advent\Year2023\Day10\Model;

use Advent\Shared\Grid\Direction;
use Advent\Shared\InvalidArgumentException;

enum PipeType: int
{
    case START = Direction::UP->value | Direction::DOWN->value | Direction::RIGHT->value | Direction::LEFT->value;
    case NORTH_SOUTH = Direction::UP->value | Direction::DOWN->value;
    case EAST_WEST = Direction::RIGHT->value | Direction::LEFT->value;
    case NORTH_EAST = Direction::UP->value | Direction::RIGHT->value;
    case NORTH_WEST = Direction::UP->value | Direction::LEFT->value;
    case SOUTH_EAST = Direction::DOWN->value | Direction::RIGHT->value;
    case SOUTH_WEST = Direction::DOWN->value | Direction::LEFT->value;

    public static function fromString(string $type): self
    {
        return match ($type) {
            '|' => self::NORTH_SOUTH,
            '-' => self::EAST_WEST,
            'L' => self::NORTH_EAST,
            'J' => self::NORTH_WEST,
            '7' => self::SOUTH_WEST,
            'F' => self::SOUTH_EAST,
            'S' => self::START,
            default => throw InvalidArgumentException::because('Invalid pipe type: %s', $type),
        };
    }

    public function isIn(Direction $direction): bool
    {
        if ($direction->isDiagonal()) {
            return false;
        }

        return ($this->value & $direction->value) === $direction->value;
    }

    /** @return Direction[] */
    public function accessibleDirections(): array
    {
        return array_values(array_filter(
            [Direction::UP, Direction::DOWN, Direction::RIGHT, Direction::LEFT],
            fn (Direction $direction): bool => $this->isIn($direction)
        ));
    }
}

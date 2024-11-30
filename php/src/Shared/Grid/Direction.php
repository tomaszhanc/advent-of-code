<?php

declare(strict_types=1);

namespace Advent\Shared\Grid;

enum Direction: int
{
    case UP         = 1;
    case DOWN       = 2;
    case LEFT       = 4;
    case RIGHT      = 8;
    case UP_LEFT    = self::UP->value | self::LEFT->value;
    case UP_RIGHT   = self::UP->value | self::RIGHT->value;
    case DOWN_LEFT  = self::DOWN->value | self::LEFT->value;
    case DOWN_RIGHT = self::DOWN->value | self::RIGHT->value;

    public function isIn(Direction $direction): bool
    {
        return ($this->value & $direction->value) === $direction->value;
    }

    public function equals(Direction $direction): bool
    {
        return $this->value === $direction->value;
    }

    public function opposite(): self
    {
        return match ($this) {
            self::UP    => self::DOWN,
            self::DOWN  => self::UP,
            self::LEFT  => self::RIGHT,
            self::RIGHT => self::LEFT,
            self::UP_LEFT => self::DOWN_RIGHT,
            self::UP_RIGHT => self::DOWN_LEFT,
            self::DOWN_LEFT => self::UP_RIGHT,
            self::DOWN_RIGHT => self::UP_LEFT,
        };
    }

    public function isDiagonal(): bool
    {
        return in_array($this, [self::UP_LEFT, self::UP_RIGHT, self::DOWN_LEFT, self::DOWN_RIGHT]);
    }
}

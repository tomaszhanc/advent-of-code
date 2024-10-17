<?php

declare(strict_types=1);

namespace Advent\Year2023\Day2\Model;

final readonly class Cubes
{
    public function __construct(public int $quantity, public Color $color)
    {
    }

    public static function red(int $quantity): self
    {
        return new self($quantity, Color::RED);
    }

    public static function green(int $quantity): self
    {
        return new self($quantity, Color::GREEN);
    }

    public static function blue(int $quantity): self
    {
        return new self($quantity, Color::BLUE);
    }
}

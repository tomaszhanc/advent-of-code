<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Mother\Day1;

use Advent\Year2023\Day1\Digit;
use Advent\Year2023\Day1\Line;

final readonly class LineMother
{
    public static function create(int ...$digits): Line
    {
        return Line::create(
            ...\array_map(fn (int $digit) => new Digit($digit), $digits)
        );
    }
}

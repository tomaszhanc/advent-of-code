<?php

declare(strict_types=1);

namespace AoC\Year2023\Day1\LineParser;

use AoC\Year2023\Day1\CalibrationDocument\Digit;
use AoC\Year2023\Day1\CalibrationDocument\Line;
use AoC\Year2023\Day1\LineParser;

final readonly class SimpleLineParser implements LineParser
{
    public function parse(string $line): Line
    {
        $matches = [];
        \preg_match_all('/(?=(\d|zero|one|two|three|four|five|six|seven|eight|nine))/', $line, $matches);

        return Line::create(
            ...\array_map(fn (string $digit) => Digit::fromString($digit), $matches[1])
        );
    }
}

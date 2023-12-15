<?php

declare(strict_types=1);

namespace AoC\Year2023\Day1;

use AoC\Common\Parser;
use AoC\Year2023\Day1\CalibrationDocument\Digit;
use AoC\Year2023\Day1\CalibrationDocument\Line;

/**
 * @template-implements Parser<Line>
 */
final readonly class SimpleLineParser implements Parser
{
    public function parse(string $input): Line
    {
        $matches = [];
        \preg_match_all('/(?=(\d|zero|one|two|three|four|five|six|seven|eight|nine))/', $input, $matches);

        return Line::create(
            ...\array_map(fn (string $digit) => Digit::fromString($digit), $matches[1])
        );
    }
}

<?php

declare(strict_types=1);

namespace Advent\Year2023\Day1;

use Advent\Shared\Parser\LineParser;
use Advent\Year2023\Day1\CalibrationDocument\Digit;
use Advent\Year2023\Day1\CalibrationDocument\Line;

/**
 * @template-implements LineParser<Line>
 */
final readonly class SimpleLineParser implements LineParser
{
    public function parse(string $line, int $lineNumber): Line
    {
        $matches = [];
        \preg_match_all('/(?=(\d|zero|one|two|three|four|five|six|seven|eight|nine))/', $line, $matches);

        return Line::create(
            ...\array_map(fn (string $digit) => Digit::fromString($digit), $matches[1])
        );
    }
}

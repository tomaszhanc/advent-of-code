<?php

declare(strict_types=1);

namespace AoC\Year2023\Doubles\Day1;

use AoC\Year2023\Day1\CalibrationDocument\Line;
use AoC\Year2023\Day1\LineParser;

final readonly class RandomLineParserStub implements LineParser
{
    public function parse(string $line): Line
    {
        return Line::of(\random_int(1, 9), \random_int(1, 9), \random_int(1, 9));
    }
}

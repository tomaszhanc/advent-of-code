<?php

declare(strict_types=1);

namespace Advent\Year2024\Day2\Parser;

use Advent\Year2024\Day2\Model\Report;

final readonly class ReportParser
{
    public function parse(string $input): Report
    {
        preg_match_all('/\d+/', $input, $matches);

        return new Report(
            ...array_map(fn (string $match): int => (int) $match, $matches[0])
        );
    }
}

<?php

declare(strict_types=1);

namespace Advent\Year2024\Day2;

use Advent\Shared\Input\Input;
use Advent\Year2024\Day2\Parser\ReportParser;

final readonly class PuzzleSolver
{
    public function __construct(
        private ReportParser $parser
    ) {
    }

    public function numberOfSafeReports(Input $input): int
    {
        $result = 0;

        foreach ($input->lines() as $line) {
            $report = $this->parser->parse($line);

            if ($report->isSafe()) {
                $result++;
            }
        }

        return $result;
    }

    public function numberOfSafeReportsWithAtMostSingleBadLevel(Input $input): int
    {
        $result = 0;

        foreach ($input->lines() as $line) {
            $report = $this->parser->parse($line);

            if ($report->isSafeWithAtMostSingleBadLevel()) {
                $result++;
            }
        }

        return $result;
    }
}

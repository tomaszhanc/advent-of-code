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

        $file = '';

        foreach ($input->lines() as $line) {
            $report = $this->parser->parse($line);

            $file .= $report->toString();

            if ($report->isSafe()) {
                $result++;
            }
        }

        file_put_contents('safe_reports.txt', $file);

        return $result;
    }
}

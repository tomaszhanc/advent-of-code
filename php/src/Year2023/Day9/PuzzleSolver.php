<?php

declare(strict_types=1);

namespace Advent\Year2023\Day9;

use Advent\Shared\Input\Input;
use Advent\Year2023\Day9\Model\SequenceExtrapolation;
use Advent\Year2023\Day9\Parser\ReportParser;

final readonly class PuzzleSolver
{
    public function __construct(
        private ReportParser $parser,
        private SequenceExtrapolation $sequenceExtrapolation
    ) {
    }

    public function sumOfNextExtrapolatedValues(Input $report): int
    {
        $sum = 0;

        foreach ($report->lines() as $unparsedLine) {
            $sequence = $this->parser->parse($unparsedLine);
            $sum += $this->sequenceExtrapolation->nextExtrapolatedValue($sequence);
        }

        return $sum;
    }

    public function sumOfPreviousExtrapolatedValues(Input $report): int
    {
        $sum = 0;

        foreach ($report->lines() as $unparsedLine) {
            $sequence = $this->parser->parse($unparsedLine);
            $sum += $this->sequenceExtrapolation->previousExtrapolatedValue($sequence);
        }

        return $sum;
    }
}

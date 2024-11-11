<?php

declare(strict_types=1);

namespace Advent\Year2023\Day1;

use Advent\Shared\Input\Input;
use Advent\Year2023\Day1\Parser\DigitLineParser;

final readonly class LinesCalibrationValues
{
    public function __construct(
        private DigitLineParser $lineParser
    ) {
    }

    public function sumAllFrom(Input $calibrationDocument): int
    {
        $sum = 0;

        foreach ($calibrationDocument->lines() as $unparsedLine) {
            $sum += $this->lineParser
                ->parse($unparsedLine)
                ->calibrationValue()
                ->asInteger();
        }

        return $sum;
    }
}

<?php

declare(strict_types=1);

namespace Advent\Year2023\Day1;

use Advent\Shared\Filesystem\File;
use Advent\Year2023\Day1\Parser\DigitLineParser;

final readonly class AllLinesCalibrationValues
{
    public function __construct(
        private DigitLineParser $lineParser
    ) {
    }

    public function sumAllFrom(File $calibrationDocument): int
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

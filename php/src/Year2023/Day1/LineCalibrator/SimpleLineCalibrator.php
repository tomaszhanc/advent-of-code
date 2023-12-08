<?php

declare(strict_types=1);

namespace AoC\Year2023\Day1\LineCalibrator;

use AoC\Year2023\Day1\CalibrationNumber;
use AoC\Year2023\Day1\LineCalibrator;
use AoC\Year2023\Day1\Digit;

final readonly class SimpleLineCalibrator implements LineCalibrator
{
    public function calibrationNumber(string $line) : CalibrationNumber
    {
        $matches = [];
        \preg_match_all('/(?=(\d|zero|one|two|three|four|five|six|seven|eight|nine))/', $line, $matches);
        $digits = $matches[1];

        return new CalibrationNumber(
            Digit::fromString($digits[\array_key_first($digits)]),
            Digit::fromString($digits[\array_key_last($digits)])
        );
    }
}

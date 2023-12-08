<?php

declare(strict_types=1);

namespace AoC\Year2023\Day1\LineCalibrator;

use AoC\Year2023\Day1\CalibrationNumber;
use AoC\Year2023\Day1\LineCalibrator;
use AoC\Year2023\Day1\LineCalibrator\Lexer\DigitParser;

final readonly class LexerLineCalibration implements LineCalibrator
{
    private DigitParser $parser;

    public function __construct()
    {
        $this->parser = new DigitParser();
    }

    public function calibrationNumber(string $line): CalibrationNumber
    {
        $digits = $this->parser->parse($line);

        return new CalibrationNumber(
            $digits[0],
            $digits[\count($digits) - 1]
        );
    }
}

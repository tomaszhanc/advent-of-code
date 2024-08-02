<?php

declare(strict_types=1);

namespace AoC\Year2023;

use AoC\Common\Filesystem;
use AoC\Common\Filesystem\SimpleFilesystem;
use AoC\Common\ParsedLineByLine;
use AoC\Year2023\Day1\CalibrationDocument;
use AoC\Year2023\Day1\LexerLineParser;
use AoC\Year2023\Day1\SimpleLineParser;

/**
 * @see https://adventofcode.com/2023/day/1
 */
final readonly class Day1
{
    public function __construct(
        private Filesystem $filesystem,
    ) {
    }

    public static function create(): self
    {
        return new self(
            new SimpleFilesystem()
        );
    }

    public function sumOfAllCalibrationValuesBuiltFromIntegersOnly(string $calibrationDocumentPath): int
    {
        return CalibrationDocument::withLines(
            new ParsedLineByLine(
                LexerLineParser::recognizeIntegers(),
                $this->filesystem,
                $calibrationDocumentPath
            )
        )->calibrationValues()->sum();
    }

    public function sumOfAllCalibrationValuesBuiltFromIntegersAndSpelledOutDigits(string $calibrationDocumentPath): int
    {
        return CalibrationDocument::withLines(
            new ParsedLineByLine(
                LexerLineParser::recognizeIntegersAndSpelledOutDigits(),
                $this->filesystem,
                $calibrationDocumentPath
            )
        )->calibrationValues()->sum();
    }

    public function sumOfAllCalibrationValuesBuiltFromIntegersAndSpelledOutDigits_MemorySafe(string $calibrationDocumentPath): int
    {
        return CalibrationDocument::withLines(
            new ParsedLineByLine(
                LexerLineParser::recognizeIntegersAndSpelledOutDigits(),
                $this->filesystem,
                $calibrationDocumentPath
            )
        )->sumOfCalibrationValues();
    }

    public function sumOfAllCalibrationValuesBuiltFromIntegersAndSpelledOutDigits_SimpleParser(string $calibrationDocumentPath): int
    {
        return CalibrationDocument::withLines(
            new ParsedLineByLine(
                new SimpleLineParser(),
                $this->filesystem,
                $calibrationDocumentPath
            )
        )->calibrationValues()->sum();
    }
}

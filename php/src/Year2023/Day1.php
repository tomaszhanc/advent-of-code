<?php

declare(strict_types=1);

namespace Advent\Year2023;

use Advent\Shared\Filesystem\Filesystem;
use Advent\Shared\Filesystem\SimpleFilesystem;
use Advent\Shared\Parser\FileLines;
use Advent\Year2023\Day1\CalibrationDocument;
use Advent\Year2023\Day1\LexerLineParser;
use Advent\Year2023\Day1\SimpleLineParser;

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
            new FileLines(
                LexerLineParser::recognizeIntegers(),
                $this->filesystem,
                $calibrationDocumentPath
            )
        )->calibrationValues()->sum();
    }

    public function sumOfAllCalibrationValuesBuiltFromIntegersAndSpelledOutDigits(string $calibrationDocumentPath): int
    {
        return CalibrationDocument::withLines(
            new FileLines(
                LexerLineParser::recognizeIntegersAndSpelledOutDigits(),
                $this->filesystem,
                $calibrationDocumentPath
            )
        )->calibrationValues()->sum();
    }

    public function sumOfAllCalibrationValuesBuiltFromIntegersAndSpelledOutDigits_MemorySafe(string $calibrationDocumentPath): int
    {
        return CalibrationDocument::withLines(
            new FileLines(
                LexerLineParser::recognizeIntegersAndSpelledOutDigits(),
                $this->filesystem,
                $calibrationDocumentPath
            )
        )->sumOfCalibrationValues();
    }

    public function sumOfAllCalibrationValuesBuiltFromIntegersAndSpelledOutDigits_SimpleParser(string $calibrationDocumentPath): int
    {
        return CalibrationDocument::withLines(
            new FileLines(
                new SimpleLineParser(),
                $this->filesystem,
                $calibrationDocumentPath
            )
        )->calibrationValues()->sum();
    }
}

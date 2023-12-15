<?php

declare(strict_types=1);

namespace AoC\Year2023;

use AoC\Common\Filesystem;
use AoC\Common\Filesystem\SimpleFilesystem;
use AoC\Year2023\Day1\CalibrationDocument;
use AoC\Year2023\Day1\LinesFromFile;
use AoC\Year2023\Day1\LineParser\LexerLinerParser;
use AoC\Year2023\Day1\LineParser\SimpleLineParser;

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

    /** Part 1 */
    public function sumOfAllCalibrationValuesBuiltFromIntegersOnly(string $calibrationDocumentPath): int
    {
        return CalibrationDocument::with(
            new LinesFromFile(
                LexerLinerParser::recognizeIntegers(),
                $this->filesystem,
                $calibrationDocumentPath
            )
        )->calibrationValues()->sum();
    }

    /** Part 2 */
    public function sumOfAllCalibrationValuesBuiltFromIntegersAndSpelledOutDigits(string $calibrationDocumentPath): int
    {
        return CalibrationDocument::with(
            new LinesFromFile(
                LexerLinerParser::recognizeIntegersAndSpelledOutDigits(),
                $this->filesystem,
                $calibrationDocumentPath
            )
        )->calibrationValues()->sum();
    }

    /** Part 2: Memory Safe */
    public function sumOfAllCalibrationValuesBuiltFromIntegersAndSpelledOutDigits_MemorySafe(string $calibrationDocumentPath): int
    {
        return CalibrationDocument::with(
            new LinesFromFile(
                LexerLinerParser::recognizeIntegersAndSpelledOutDigits(),
                $this->filesystem,
                $calibrationDocumentPath
            )
        )->sumOfCalibrationValues();
    }

    /** Part 2: Simple parser instead of Lexer */
    public function sumOfAllCalibrationValuesBuiltFromIntegersAndSpelledOutDigits_SimpleParser(string $calibrationDocumentPath): int
    {
        return CalibrationDocument::with(
            new LinesFromFile(
                new SimpleLineParser(),
                $this->filesystem,
                $calibrationDocumentPath
            )
        )->calibrationValues()->sum();
    }
}

<?php

declare(strict_types=1);

namespace Advent\Year2023;

use Advent\Shared\Filesystem\Filesystem;
use Advent\Shared\Filesystem\LocalFile;
use Advent\Shared\Filesystem\SimpleFilesystem;
use Advent\Year2023\Day1\Parser\DigitLexer;
use Advent\Year2023\Day1\Parser\DigitLineParser;
use Advent\Year2023\Day1\AllLinesCalibrationValues;

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

    public function partOne_sumAllCalibrationValues(string $calibrationDocumentPath): int
    {
        return (
            new AllLinesCalibrationValues(
                new DigitLineParser(
                    DigitLexer::numericDigitsOnly()
                )
            )
        )->sumAllFrom(new LocalFile($this->filesystem, $calibrationDocumentPath));
    }

    public function partTwo_sumAllCalibrationValues(string $calibrationDocumentPath): int
    {
        return (
            new AllLinesCalibrationValues(
                new DigitLineParser(
                    DigitLexer::numericAndWordDigits()
                )
            )
        )->sumAllFrom(new LocalFile($this->filesystem, $calibrationDocumentPath));
    }
}

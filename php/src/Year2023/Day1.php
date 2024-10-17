<?php

declare(strict_types=1);

namespace Advent\Year2023;

use Advent\Shared\Filesystem\Filesystem;
use Advent\Shared\Filesystem\LocalFile;
use Advent\Shared\Filesystem\SimpleFilesystem;
use Advent\Year2023\Day1\LinesCalibrationValues;
use Advent\Year2023\Day1\Parser\DigitLexer;
use Advent\Year2023\Day1\Parser\DigitLineParser;

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
        return new self(new SimpleFilesystem());
    }

    public function partOne_sumAllCalibrationValues(string $calibrationDocumentPath): int
    {
        $calibrationValues = new LinesCalibrationValues(new DigitLineParser(DigitLexer::numericDigits()));

        return $calibrationValues->sumAllFrom(new LocalFile($this->filesystem, $calibrationDocumentPath));
    }

    public function partTwo_sumAllCalibrationValues(string $calibrationDocumentPath): int
    {
        $calibrationValues = new LinesCalibrationValues(new DigitLineParser(DigitLexer::numericAndWordDigits()));

        return $calibrationValues->sumAllFrom(new LocalFile($this->filesystem, $calibrationDocumentPath));
    }
}

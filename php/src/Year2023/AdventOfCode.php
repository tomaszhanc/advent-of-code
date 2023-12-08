<?php

declare(strict_types=1);

namespace AoC\Year2023;

use AoC\Common\Filesystem\SimpleFilesystem;
use AoC\Year2023\Day1\DocumentCalibrator;
use AoC\Year2023\Day1\LineCalibrator\LexerLineCalibration;

final readonly class AdventOfCode
{
    public function __construct(
        private DocumentCalibrator $dayOne
    ) {
    }

    public static function create() : self
    {
        return new self(
            new DocumentCalibrator(
                new SimpleFilesystem(),
                new LexerLineCalibration()
            )
        );
    }

    /**
     * @see https://adventofcode.com/2023/day/1
     */
    public function calibrateDocument(string $documentPath) : int
    {
        return $this->dayOne->calibrate($documentPath);
    }
}

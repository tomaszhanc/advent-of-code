<?php

declare(strict_types=1);

namespace AoC\Year2023;

use AoC\Common\Filesystem\SimpleFilesystem;
use AoC\Year2023\Day1\DocumentCalibrator;
use AoC\Year2023\Day1\LineCalibrator\LexerLineCalibration;
use AoC\Year2023\Day2\Game\CubesSet;
use AoC\Year2023\Day2\GameListCheckSum;
use AoC\Year2023\Day2\Lexer\GameParser;

final readonly class AdventOfCode
{
    public function __construct(
        private DocumentCalibrator $dayOne,
        private GameListCheckSum   $dayTwo,
    ) {
    }

    public static function create(): self
    {
        $fileSystem = new SimpleFilesystem();

        return new self(
            new DocumentCalibrator($fileSystem, new LexerLineCalibration()),
            new GameListCheckSum($fileSystem, new GameParser())
        );
    }

    /** @see https://adventofcode.com/2023/day/1 */
    public function calibrateDocument(string $documentPath): int
    {
        return $this->dayOne->calibrate($documentPath);
    }

    /** @see https://adventofcode.com/2023/day/2 */
    public function checkSumOfGameList(string $gameListPath, CubesSet $cubesSet) : int
    {
        return $this->dayTwo->checkSumOf($gameListPath, $cubesSet);
    }
}

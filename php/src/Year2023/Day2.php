<?php

declare(strict_types=1);

namespace Advent\Year2023;

use Advent\Shared\Filesystem\Filesystem;
use Advent\Shared\Filesystem\LocalFile;
use Advent\Shared\Filesystem\SimpleFilesystem;
use Advent\Year2023\Day2\GameEvaluator;
use Advent\Year2023\Day2\Model\CubesSet;
use Advent\Year2023\Day2\Parser\GameLexer;
use Advent\Year2023\Day2\Parser\GameParser;

/**
 * @see https://adventofcode.com/2023/day/2
 */
final readonly class Day2
{
    public function __construct(
        private Filesystem $filesystem,
        private GameEvaluator $gameEvaluator
    ) {
    }

    public static function create(): self
    {
        return new self(
            new SimpleFilesystem(),
            new GameEvaluator(new GameParser(new GameLexer()))
        );
    }

    public function partOne_sumAllPossibleGameIds(CubesSet $cubesSet, string $gamesRecordFilePath): int
    {
        return $this->gameEvaluator->sumAllPossibleGameIdsFor(
            $cubesSet,
            new LocalFile($this->filesystem, $gamesRecordFilePath)
        );
    }

    public function partTwo_sumOfAllMinimumCubesSetsPowers(string $gameRecordFilePath): int
    {
        return $this->gameEvaluator->sumPowerOfAllSmallestCubesSetAllowingToPlayGame(
            new LocalFile($this->filesystem, $gameRecordFilePath)
        );
    }
}

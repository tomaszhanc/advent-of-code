<?php

declare(strict_types=1);

namespace AoC\Year2023;

use AoC\Common\Filesystem;
use AoC\Common\Filesystem\SimpleFilesystem;
use AoC\Common\ParsedLineByLine;
use AoC\Year2023\Day2\GameParser;
use AoC\Year2023\Day2\GamesRecord;
use AoC\Year2023\Day2\GamesRecord\CubesSet;

/**
 * @see https://adventofcode.com/2023/day/2
 */
final readonly class Day2
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

    public function sumOfAllPossibleToBePlayedOutGameIdsFor(string $gameRecordFilePath, CubesSet $cubesSet): int
    {
        return GamesRecord::withGames(
            new ParsedLineByLine(
                new GameParser(),
                $this->filesystem,
                $gameRecordFilePath
            )
        )->possibleGamesFor($cubesSet)->sumOfAllGameIds();
    }

    public function sumOfAllPossibleToBePlayedOutGameIdsFor_MemorySafe(string $gameRecordFilePath, CubesSet $cubesSet): int
    {
        return GamesRecord::withGames(
            new ParsedLineByLine(
                new GameParser(),
                $this->filesystem,
                $gameRecordFilePath
            )
        )->sumOfPossibleGameIdsFor($cubesSet);
    }

    public function sumOfAllMinimumCubesSetsPowers(string $gameRecordFilePath): int
    {
        return GamesRecord::withGames(
            new ParsedLineByLine(
                new GameParser(),
                $this->filesystem,
                $gameRecordFilePath
            )
        )->minimumCubesSetsToPlay()->sumOfAllPowers();
    }
}

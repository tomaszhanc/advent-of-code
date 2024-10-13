<?php

declare(strict_types=1);

namespace Advent\Year2023;

use Advent\Shared\Filesystem\Filesystem;
use Advent\Shared\Filesystem\SimpleFilesystem;
use Advent\Year2023\Day2\GameParserDeprecated;
use Advent\Year2023\Day2\GamesRecord;
use Advent\Year2023\Day2\GamesRecord\CubesSet;

/** @see https://adventofcode.com/2023/day/2 */
final readonly class Day2
{
    public function __construct(
        private Filesystem $filesystem,
    ) {
    }

    public static function create(): self
    {
        return new self(new SimpleFilesystem());
    }

    public function sumOfAllPossibleToBePlayedOutGameIdsFor(string $gameRecordFilePath, CubesSet $cubesSet): int
    {
        return GamesRecord::withGames(
            new DeprecatedFileLines(
                new GameParserDeprecated(),
                $this->filesystem,
                $gameRecordFilePath
            )
        )->possibleGamesFor($cubesSet)->sumOfAllGameIds();
    }

    public function sumOfAllMinimumCubesSetsPowers(string $gameRecordFilePath): int
    {
        return GamesRecord::withGames(
            new DeprecatedFileLines(
                new GameParserDeprecated(),
                $this->filesystem,
                $gameRecordFilePath
            )
        )->minimumCubesSetsToPlay()->sumOfAllPowers();
    }
}

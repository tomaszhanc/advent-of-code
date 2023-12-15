<?php

declare(strict_types=1);

namespace AoC\Year2023;

use AoC\Common\Filesystem;
use AoC\Common\Filesystem\SimpleFilesystem;
use AoC\Year2023\Day2\Game\CubesSet;
use AoC\Year2023\Day2\GameListCheckSum;
use AoC\Year2023\Day2\Lexer\GameParser;

final readonly class Day2
{
    public function __construct(
        private Filesystem       $filesystem,
        private GameListCheckSum $dayTwo,
    ) {
    }

    public static function create(): self
    {
        $fileSystem = new SimpleFilesystem();

        return new self(
            $fileSystem,
            new GameListCheckSum($fileSystem, new GameParser())
        );
    }



    /** Day 2 Part 1 @see https://adventofcode.com/2023/day/2 */
    public function checkSumOfGameList(string $gameListPath, CubesSet $cubesSet): int
    {
        return $this->dayTwo->checkSumOf($gameListPath, $cubesSet);
    }

    /** Day 2 part 2 */
    public function bla(string $gameListPath, CubesSet $cubesSet): int
    {
        return $this->dayTwo->sumOfPowersOfMinimumCubesSetsToPlayAGame($gameListPath)->bla();
    }
}

<?php

declare(strict_types=1);

namespace AoC\Year2023\Day2;

use AoC\Common\Filesystem;
use AoC\Year2023\Day2\Game\CubesSet;
use AoC\Year2023\Day2\Lexer\GameParser;

final readonly class GameListCheckSum
{
    public function __construct(private Filesystem $filesystem, private GameParser $gameParser)
    {
    }

    public function checkSumOf(string $gameListFilePath, CubesSet $cubeSet) : int
    {
        $sumOfGameIds = 0;

        foreach ($this->filesystem->readLineByLine($gameListFilePath) as $line) {
            $game = $this->gameParser->parse($line);

            if ($game->couldHaveBeenPlayedWith($cubeSet)) {
                $sumOfGameIds += $game->gameId;
            }
        }

        return $sumOfGameIds;
    }

    public function sumOfPowersOfMinimumCubesSetsToPlayAGame(string $gameListFilePath) : int
    {
        $sumOfPowers = 0;

        foreach ($this->filesystem->readLineByLine($gameListFilePath) as $line) {
            $game = $this->gameParser->parse($line);

            $sumOfPowers += $game->theSmallestCubeSet()->power();
        }

        return $sumOfPowers;
    }
}

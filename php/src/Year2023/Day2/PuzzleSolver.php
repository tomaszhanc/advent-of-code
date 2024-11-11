<?php

declare(strict_types=1);

namespace Advent\Year2023\Day2;

use Advent\Shared\Input\Input;
use Advent\Year2023\Day2\Model\CubesSet;
use Advent\Year2023\Day2\Parser\GameParser;

final readonly class PuzzleSolver
{
    public function __construct(
        private GameParser $gameParser
    ) {
    }

    public function sumAllPossibleGameIdsFor(CubesSet $cubesSet, Input $gamesRecordFilePath): int
    {
        $sum = 0;

        foreach ($gamesRecordFilePath->lines() as $unparsedLine) {
            $game = $this->gameParser->parse($unparsedLine);

            if ($game->canBePlayedWith($cubesSet)) {
                $sum += $game->gameId;
            }
        }

        return $sum;
    }

    public function sumPowerOfAllMinimumCubesSetsAllowingToPlayGame(Input $gamesRecordFilePath): int
    {
        $sum = 0;

        foreach ($gamesRecordFilePath->lines() as $unparsedLine) {
            $game = $this->gameParser->parse($unparsedLine);

            $sum += $game->findSmallestCubesSetToPlay()->power();
        }

        return $sum;
    }
}

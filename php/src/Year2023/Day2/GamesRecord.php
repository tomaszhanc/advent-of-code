<?php

declare(strict_types=1);

namespace Advent\Year2023\Day2;

use Advent\Year2023\Day2\GamesRecord\CubesSet;
use Advent\Year2023\Day2\GamesRecord\CubesSets;
use Advent\Year2023\Day2\GamesRecord\Game;
use Advent\Year2023\Day2\GamesRecord\Games;

final readonly class GamesRecord
{
    /**
     * @param Game[] $games
     */
    public function __construct(private iterable $games)
    {
    }

    public static function withGames(iterable $games): self
    {
        return new self($games);
    }

    /**
     * This method is not memory-safe.
     * It will keep as many Games as lines we have in the memory.
     *
     * @see sumOfPossibleGameIdsFor for memory-safe apporach
     */
    public function possibleGamesFor(CubesSet $cubesSet): Games
    {
        $possibleGames = [];

        foreach ($this->games as $game) {
            if ($game->canBePlayedOutWith($cubesSet)) {
                $possibleGames[] = $game;
            }
        }

        return Games::create(...$possibleGames);
    }

    /**
     * This method keeps track only of the sum of possible games to be played out.
     * After a game is processed, it no longer uses any memory for it.
     */
    public function sumOfPossibleGameIdsFor(CubesSet $cubesSet): int
    {
        $sum = 0;

        foreach ($this->games as $game) {
            if ($game->canBePlayedOutWith($cubesSet)) {
                $sum += $game->gameId;
            }
        }

        return $sum;
    }

    /**
     * This method is not memory-safe on purpose.
     */
    public function minimumCubesSetsToPlay(): CubesSets
    {
        $cubesSets = [];

        foreach ($this->games as $game) {
            $cubesSets[] = $game->smallestCubesSetToPlay();
        }

        return CubesSets::create(...$cubesSets);
    }
}

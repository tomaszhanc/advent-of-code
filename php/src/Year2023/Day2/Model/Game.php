<?php

declare(strict_types=1);

namespace Advent\Year2023\Day2\Model;

final readonly class Game
{
    /** * @var CubesSet[] */
    private array $gameRounds;

    public function __construct(public int $gameId, CubesSet ...$gameRounds)
    {
        $this->gameRounds = $gameRounds;
    }

    public function canBePlayedWith(CubesSet $cubesSet): bool
    {
        foreach ($this->gameRounds as $gameRound) {
            foreach ($gameRound->cubes as $cubes) {
                if ($cubes->quantity > $cubesSet->quantityOf($cubes->color)) {
                    return false;
                }
            }
        }

        return true;
    }

    public function findSmallestCubesSetToPlay(): CubesSet
    {
        $smallestCubesSet = CubesSet::empty();

        foreach ($this->gameRounds as $gameRound) {
            foreach ($gameRound->cubes as $cubes) {
                if ($cubes->quantity > $smallestCubesSet->quantityOf($cubes->color)) {
                    $smallestCubesSet = $smallestCubesSet->replaceWith($cubes);
                }
            }
        }

        return $smallestCubesSet;
    }
}

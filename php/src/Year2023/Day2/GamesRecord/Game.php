<?php

declare(strict_types=1);

namespace AoC\Year2023\Day2\GamesRecord;

final readonly class Game
{
    /** * @var CubesSet[] */
    private array $cubesSets;

    public function __construct(public int $gameId, CubesSet ...$cubesSets)
    {
        $this->cubesSets = $cubesSets;
    }

    public function canBePlayedOutWith(CubesSet $cubesSet): bool
    {
        foreach ($this->cubesSets as $theCubesSet) {
            if (!$cubesSet->hasAllFrom($theCubesSet)) {
                return false;
            }
        }

        return true;
    }

    public function smallestCubesSetToPlay(): CubesSet
    {
        $smallestCubeSet = CubesSet::empty();

        foreach ($this->cubesSets as $cubesSet) {
            foreach ($cubesSet->cubes as $cube) {
                $smallestCubeSet = $smallestCubeSet->withGreaterQuantity($cube);
            }
        }

        return $smallestCubeSet;
    }
}

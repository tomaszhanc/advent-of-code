<?php

declare(strict_types=1);

namespace AoC\Year2023\Day2;

use AoC\Year2023\Day2\Game\CubesSet;

final readonly class Game
{
    /** * @var CubesSet[] */
    private array $cubesSets;

    public function __construct(public int $gameId, CubesSet ...$cubeSets)
    {
        $this->cubesSets = $cubeSets;
    }

    public function couldHaveBeenPlayedWith(CubesSet $cubeSet) : bool
    {
        foreach ($this->cubesSets as $theCubeSet) {
            if (!$cubeSet->isSubsetOf($theCubeSet)) {
                return false;
            }
        }

        return true;
    }

    public function theSmallestCubeSet() : CubesSet
    {
        $theSmallestCubeSet = CubesSet::empty();

        foreach ($this->cubesSets as $cubesSet) {
            foreach ($cubesSet->cubes as $cube) {
                $theSmallestCubeSet = $theSmallestCubeSet->withGreaterQuantity($cube);
            }
        }

        return $theSmallestCubeSet;
    }
}

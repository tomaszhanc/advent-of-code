<?php

declare(strict_types=1);

namespace AoC\Year2023\Day2;

use AoC\Year2023\Day2\Game\CubesSet;

final readonly class Game
{
    /** * @var CubesSet[] */
    private array $cubesSets;

    public function __construct(public int $gameId, CubesSet ...$gameSets)
    {
        $this->cubesSets = $gameSets;
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
}

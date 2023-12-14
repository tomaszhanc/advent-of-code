<?php

declare(strict_types=1);

namespace AoC\Year2023\Day2\Game;

final readonly class CubesSet
{
    /** * @var Cubes[] */
    private array $cubes;

    public function __construct(Cubes ...$revealedCubes)
    {
        $this->cubes = $revealedCubes;
    }

    /**
     * Does $this CubeSet contain all the cubes from the given $cubeSet?
     */
    public function isSubsetOf(CubesSet $cubeSet) : bool
    {
        foreach ($cubeSet->cubes as $cube) {
            $thisCubes = $this->cubesOf($cube->color);

            if ($thisCubes->quantity < $cube->quantity) {
                return false;
            }
        }

        return true;
    }

    private function cubesOf(Color $color) : Cubes
    {
        foreach ($this->cubes as $cube) {
            if ($cube->color === $color) {
                return $cube;
            }
        }

        return Cubes::zero($color);
    }
}

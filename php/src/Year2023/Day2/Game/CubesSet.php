<?php

declare(strict_types=1);

namespace AoC\Year2023\Day2\Game;

final readonly class CubesSet
{
    /**
     * @param Cubes[] $cubes
     */
    private function __construct(public array $cubes)
    {
    }

    public static function of(Cubes ...$cubes) : self
    {
        return new self($cubes);
    }

    public static function empty() : self
    {
        return new self([]);
    }

    public function withGreaterQuantity(Cubes $cubes) : self
    {
        $result = \array_values(\array_filter(
            $this->cubes,
            fn (Cubes $theCubes) => $theCubes->color !== $cubes->color
        ));

        $theCubes = $this->cubesOf($cubes->color);
        $result[] = $theCubes->quantity > $cubes->quantity ? $theCubes : $cubes;

        return new self($result);
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

    public function power() : int
    {
        return (int) \array_product(
            \array_map(fn (Cubes $cubes) => $cubes->quantity, $this->cubes)
        );
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

<?php

declare(strict_types=1);

namespace AoC\Year2023\Day2\GamesRecord;

final readonly class CubesSets
{
    /**
     * @param CubesSet[] $cubesSets
     */
    public function __construct(private array $cubesSets)
    {
    }

    public static function create(CubesSet ...$cubesSets) : self
    {
        return new self($cubesSets);
    }

    public function sumOfAllPowers() : int
    {
        return \array_sum(
            \array_map(fn (CubesSet $cubesSet) => $cubesSet->power(), $this->cubesSets)
        );
    }
}

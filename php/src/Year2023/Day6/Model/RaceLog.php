<?php

declare(strict_types=1);

namespace Advent\Year2023\Day6\Model;

final readonly class RaceLog
{
    /** @var Race[] */
    private array $races;

    public function __construct(Race ...$races)
    {
        $this->races = $races;
    }

    /**
     * @template T
     * @param callable(T, Race) : T $reducer
     * @param T $initial
     * @return T
     */
    public function reduce(callable $reducer, mixed $initial): mixed
    {
        return array_reduce($this->races, $reducer, $initial);
    }
}

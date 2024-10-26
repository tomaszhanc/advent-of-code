<?php

declare(strict_types=1);

namespace Advent\Year2023\Day5\Model\Almanac;

final readonly class Seeds
{
    /** @var int[] */
    private array $seeds;

    public function __construct(int ...$seeds)
    {
        $this->seeds = $seeds;
    }

    /** @return int[] */
    public function asSeeds(): iterable
    {
        return $this->seeds;
    }

    /** @return SeedRange[] */
    public function asRanges(): iterable
    {
        for ($i = 0; $i < count($this->seeds); $i += 2) {
            yield new SeedRange($this->seeds[$i], $this->seeds[$i + 1]);
        }
    }
}

<?php

declare(strict_types=1);

namespace Advent\Year2023\Day5\Model\Almanac;

use Advent\Shared\Range\Range;
use Advent\Shared\Range\Ranges;

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

    public function asRanges(): Ranges
    {
        $ranges = [];

        for ($i = 0; $i < count($this->seeds); $i += 2) {
            $ranges[] = Range::ofLength($this->seeds[$i], $this->seeds[$i + 1]);
        }

        return new Ranges(...$ranges);
    }
}

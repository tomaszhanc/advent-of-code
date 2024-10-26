<?php

declare(strict_types=1);

namespace Advent\Year2023\Day5\Model\Almanac;

final readonly class Map
{
    /** @var MapRange[] */
    private array $ranges;

    public function __construct(MapRange ...$ranges)
    {
        $this->ranges = $ranges;
    }

    public function destinationNumber(int $sourceNumber): int
    {
        foreach ($this->ranges as $range) {
            if ($range->isFor($sourceNumber)) {
                return $range->destinationNumber($sourceNumber);
            }
        }

        return $sourceNumber;
    }
}

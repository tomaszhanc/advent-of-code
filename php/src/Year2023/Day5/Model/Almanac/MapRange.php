<?php

declare(strict_types=1);

namespace Advent\Year2023\Day5\Model\Almanac;

final readonly class MapRange
{
    public function __construct(
        private int $destinationRangeStart,
        private int $sourceRangeStart,
        private int $rangeLength
    ) {
    }

    public function isFor(int $sourceNumber): bool
    {
        return $sourceNumber >= $this->sourceRangeStart
            && $sourceNumber < $this->sourceRangeStart + $this->rangeLength;
    }

    public function destinationNumber(int $sourceNumber): int
    {
        if (!$this->isFor($sourceNumber)) {
            throw new \RuntimeException('Source number is not in range');
        }

        return $sourceNumber - $this->sourceRangeStart + $this->destinationRangeStart;
    }
}

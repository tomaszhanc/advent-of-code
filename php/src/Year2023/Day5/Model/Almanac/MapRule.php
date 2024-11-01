<?php

declare(strict_types=1);

namespace Advent\Year2023\Day5\Model\Almanac;

use Advent\Shared\Range\Range;

final readonly class MapRule
{
    public function __construct(
        private int $sourceRangeStart,
        private int $destinationRangeStart,
        private int $rangeLength
    ) {
    }

    public static function create(
        int $destinationRangeStart,
        int $sourceRangeStart,
        int $rangeLength
    ): self {
        return new self($sourceRangeStart, $destinationRangeStart, $rangeLength);
    }

    public function isFor(int $sourceNumber): bool
    {
        return $sourceNumber >= $this->sourceRangeStart
            && $sourceNumber < $this->sourceRangeStart + $this->rangeLength;
    }

    public function sourceRange(): Range
    {
        return Range::ofLength($this->sourceRangeStart, $this->rangeLength);
    }

    public function destinationNumber(int $sourceNumber): int
    {
        if (!$this->isFor($sourceNumber)) {
            throw new \RuntimeException('Source number is not in range');
        }

        return $sourceNumber - $this->sourceRangeStart + $this->destinationRangeStart;
    }
}

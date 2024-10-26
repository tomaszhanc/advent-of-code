<?php

declare(strict_types=1);

namespace Advent\Year2023\Day5\Model\Almanac;

final readonly class Range
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

    // FIXME NEXT TEST !!!!
    public function destinationNumber(int $sourceNumber): int
    {
        if (!$this->isFor($sourceNumber)) {
            throw new \RuntimeException('Source number is not in range');
        }

        return $sourceNumber - $this->sourceRangeStart + $this->destinationRangeStart;
    }

    // seed-to-soil map
    // 50 98 2
    //    source range starts at 98 and contains two values: 98 and 99
    //    destination range starts at 50 and contains two values: 50 and 51
    //        seed number 98 corresponds to soil number 50 and
    //        seed number 99 corresponds to soil number 51
    // 52 50 48
    //    source range starts at 50 and contains 48 values: 50 through 97
    //    destination range starts at 52 and contains 48 values: 52 through 99
    //        seed number 50 corresponds to soil number 52 and
    //        seed number 97 corresponds to soil number 99
    // Any source numbers that aren't mapped correspond to the same destination number.
    //        seed number 10 corresponds to soil number 10


    // seeds: 79 14 55 13
    // With this map, you can look up the soil number required for each initial seed number:
    //  Seed number 79 corresponds to soil number 81.
    //  Seed number 14 corresponds to soil number 14.
    //  Seed number 55 corresponds to soil number 57.
    //  Seed number 13 corresponds to soil number 13.
}

<?php

declare(strict_types=1);

namespace Advent\Year2023\Day5\Model\Almanac;

final readonly class SeedRange
{
    public function __construct(
        public int $start,
        private int $length
    ) {
    }

    public function end(): int
    {
        return $this->start + $this->length - 1;
    }

    /** @return int[] */
    public function seeds(): iterable
    {
        for ($i = $this->start; $i < $this->start + $this->length; $i++) {
            yield $i;
        }
    }
}

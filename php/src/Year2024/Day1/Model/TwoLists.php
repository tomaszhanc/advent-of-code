<?php

declare(strict_types=1);

namespace Advent\Year2024\Day1\Model;

use Advent\Shared\Other\NumberList;

final readonly class TwoLists
{
    public function __construct(
        private NumberList $list1,
        private NumberList $list2,
    ) {
    }

    public function totalDistance(): int
    {
        return array_sum(
            array_map(
                fn (int $a, int $b) => abs($a - $b),
                $this->list1->sortedAscending(),
                $this->list2->sortedAscending()
            ),
        );
    }

    public function similarityScore(): int
    {
        return array_sum(
            array_map(
                fn (int $number) => $number * $this->list2->occurrenceOf($number),
                $this->list1->sortedAscending(),
            ),
        );
    }
}

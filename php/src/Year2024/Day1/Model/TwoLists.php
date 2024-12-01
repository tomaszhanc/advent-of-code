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
        $sortedList1 = $this->list1->sortedAscending();
        $sortedList2 = $this->list2->sortedAscending();

        $sum = 0;

        for ($i = 0; $i < count($sortedList1); $i++) {
            $sum += abs($sortedList1[$i] - $sortedList2[$i]);
        }

        return $sum;
    }
}

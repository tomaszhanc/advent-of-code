<?php

declare(strict_types=1);

namespace Advent\Year2024\Day5\Model;

use Advent\Shared\Other\NumberList;

final readonly class PriorityList
{
    public function __construct(
        private NumberList $priorityList
    ) {
    }

    public function isInTheRightOrder(NumberList $list): bool
    {
        $sorted = $list->sort(function (int $a, int $b): int {
            return $this->priorityList->indexOf($a) <=> $this->priorityList->indexOf($b);
        });

        return $sorted === $list->toArray();
    }

    public function sortList(NumberList $list): NumberList
    {
        $sorted = $list->sort(function (int $a, int $b): int {
            return $this->priorityList->indexOf($a) <=> $this->priorityList->indexOf($b);
        });

        return new NumberList(...$sorted);
    }
}

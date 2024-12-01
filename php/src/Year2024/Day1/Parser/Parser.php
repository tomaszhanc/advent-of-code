<?php

declare(strict_types=1);

namespace Advent\Year2024\Day1\Parser;

use Advent\Shared\Other\NumberList;
use Advent\Year2024\Day1\Model\TwoLists;

final readonly class Parser
{
    public function parse(string $content): TwoLists
    {
        $lines = explode("\n", $content);

        $list1 = [];
        $list2 = [];

        foreach ($lines as $line) {
            preg_match('/^(\d+)\s+(\d+)$/', $line, $matches);

            $list1[] = (int) $matches[1];
            $list2[] = (int) $matches[2];

        }

        return new TwoLists(
            new NumberList(...$list1),
            new NumberList(...$list2)
        );
    }
}

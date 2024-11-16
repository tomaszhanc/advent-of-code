<?php

declare(strict_types=1);

namespace Advent\Year2023\Day9\Model;

final readonly class SequenceExtrapolation
{
    public function nextExtrapolatedValue(Sequence $sequence): int
    {
        $lastNumbers = [];

        while (!$sequence->fullOfZeros()) {
            $lastNumbers[] = $sequence->lastNumber();
            $sequence = $sequence->calculateDifferenceBetweenNeighbors();
        }

        return array_sum($lastNumbers);
    }

    public function previousExtrapolatedValue(Sequence $sequence): int
    {
        $firstNumbers = [];

        while (!$sequence->fullOfZeros()) {
            $firstNumbers[] = $sequence->firstNumber();
            $sequence = $sequence->calculateDifferenceBetweenNeighbors();
        }

        $firstNumbers = array_map(
            fn (int $index, int $number) => $index % 2 === 0 ? $number : -$number,
            array_keys($firstNumbers),
            $firstNumbers
        );

        return array_sum($firstNumbers);
    }
}

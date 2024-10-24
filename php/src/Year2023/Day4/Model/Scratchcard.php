<?php

declare(strict_types=1);

namespace Advent\Year2023\Day4\Model;

final readonly class Scratchcard
{
    /**
     * @param array<int> $winningNumbers
     * @param array<int> $scratchedNumbers
     */
    public function __construct(
        private int $cardId,
        private array $winningNumbers,
        private array $scratchedNumbers
    ) {
    }

    public function points(): int
    {
        $winningNumbers = array_intersect($this->winningNumbers, $this->scratchedNumbers);

        if (count($winningNumbers) === 0) {
            return 0;
        }

        return pow(2, count($winningNumbers) - 1);
    }
}

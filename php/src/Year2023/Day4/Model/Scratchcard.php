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
        public int $cardId,
        private array $winningNumbers,
        private array $scratchedNumbers
    ) {
    }

    public function points(): int
    {
        $winningNumbersCount = count($this->winningNumbers());

        if ($winningNumbersCount === 0) {
            return 0;
        }

        return pow(2, $winningNumbersCount - 1);
    }

    /** @return int[] */
    public function wonScratchcardIds(): array
    {
        $winningNumbersCount = count($this->winningNumbers());
        $wonScratchcardIds = [];

        for ($i = 1; $i <= $winningNumbersCount; $i++) {
            $wonScratchcardIds[] = $this->cardId + $i;
        }

        return $wonScratchcardIds;
    }

    /** @return int[] */
    private function winningNumbers(): array
    {
        return array_intersect($this->winningNumbers, $this->scratchedNumbers);
    }
}

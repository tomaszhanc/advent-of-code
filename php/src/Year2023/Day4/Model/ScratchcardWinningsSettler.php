<?php

declare(strict_types=1);

namespace Advent\Year2023\Day4\Model;

final class ScratchcardWinningsSettler
{
    /**
     * @var array<int, int>
     */
    private array $copies = [];

    public function settleWinningsFor(Scratchcard $scratchcard): void
    {
        $this->addCopiesFor($scratchcard->cardId, 1);
        $multiplier = $this->multiplierFor($scratchcard);

        foreach ($scratchcard->wonScratchcardIds() as $cardId) {
            $this->addCopiesFor($cardId, $multiplier);
        }
    }

    public function total(): int
    {
        return array_sum($this->copies);
    }

    private function multiplierFor(Scratchcard $scratchcard): int
    {
        return $this->copies[$scratchcard->cardId];
    }

    private function addCopiesFor(int $cardId, int $count): void
    {
        if (!isset($this->copies[$cardId])) {
            $this->copies[$cardId] = 0;
        }

        $this->copies[$cardId] += $count;
    }
}

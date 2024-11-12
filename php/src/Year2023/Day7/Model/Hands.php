<?php

declare(strict_types=1);

namespace Advent\Year2023\Day7\Model;

final class Hands
{
    /** @var Hand[] */
    private array $hands;

    public function __construct(Hand ...$hands)
    {
        $this->hands = $hands;
    }

    public function totalWinnings(GameRules $rules): int
    {
        uasort($this->hands, new HandStrengthComparator($rules));

        $multiplier = 1;
        $winnings = 0;

        foreach ($this->hands as $hand) {
            $winnings += $hand->bid * $multiplier;
            $multiplier++;
        }

        return $winnings;
    }
}

<?php

declare(strict_types=1);

namespace Advent\Year2023\Day7\Model;

final readonly class HandStrengthComparator
{
    public function __construct(private GameRules $rules)
    {
    }

    public function __invoke(Hand $a, Hand $b): int
    {
        $comparison = $this->rules->handStrength($a)->strength() <=> $this->rules->handStrength($b)->strength();

        if ($comparison !== 0) {
            return $comparison;
        }

        for ($i = 1; $i <= 5; $i++) {
            $comparison = $this->rules->cardStrength($a->card($i)) <=> $this->rules->cardStrength($b->card($i));

            if ($comparison !== 0) {
                return $comparison;
            }
        }

        return 0;
    }
}

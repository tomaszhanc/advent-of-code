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
        $comparison = $a->type($this->rules)->strength() <=> $b->type($this->rules)->strength();

        if ($comparison !== 0) {
            return $comparison;
        }

        for ($i = 1; $i <= 5; $i++) {
            $comparison = $a->card($i)->strength($this->rules) <=> $b->card($i)->strength($this->rules);

            if ($comparison === 0) {
                continue;
            }

            return $comparison;
        }

        return 0;
    }
}

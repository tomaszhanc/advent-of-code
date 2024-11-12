<?php

declare(strict_types=1);

namespace Advent\Year2023\Day7\Model;

final readonly class HandStrengthComparator
{
    public function __invoke(Hand $a, Hand $b): int
    {
        if ($a->type()->value != $b->type()->value) {
            return $a->type()->strength() <=> $b->type()->strength();
        }

        for ($i = 1; $i <= 5; $i++) {
            if ($a->card($i)->strength() === $b->card($i)->strength()) {
                continue;
            }

            return $a->card($i)->strength() <=> $b->card($i)->strength();
        }

        return 0;
    }
}

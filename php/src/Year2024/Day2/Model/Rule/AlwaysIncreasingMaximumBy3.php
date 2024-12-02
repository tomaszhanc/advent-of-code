<?php

declare(strict_types=1);

namespace Advent\Year2024\Day2\Model\Rule;

use Advent\Year2024\Day2\Model\Rule;

final readonly class AlwaysIncreasingMaximumBy3 implements Rule
{
    public function isSatisfied(int $current, int $next): bool
    {
        return $next - $current <= 3 && $next - $current >= 1;
    }
}

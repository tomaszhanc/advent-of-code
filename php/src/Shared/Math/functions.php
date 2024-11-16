<?php

declare(strict_types=1);

namespace Advent\Shared\Math;

function greatestCommonDivisor(int $a, int $b): int
{
    $gcd = $a;

    while ($b !== 0) {
        $remainder = $gcd % $b;
        $gcd = $b;
        $b = $remainder;
    }

    return $gcd;
}

function lowestCommonMultiple(int ...$numbers): int
{
    $a = array_shift($numbers);

    foreach ($numbers as $b) {
        $a = abs($a * $b) / greatestCommonDivisor($a, $b);
    }

    return $a;
}

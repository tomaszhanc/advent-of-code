<?php

declare(strict_types=1);

namespace Advent\Year2023\Day3\Model;

final readonly class Gears
{
    /** @var Gear[] */
    private array $gears;

    public function __construct(Gear ...$gears)
    {
        $this->gears = $gears;
    }

    public function sumGearRatios(): int
    {
        return array_sum(array_map(
            fn (Gear $gear) => $gear->gearRatio(),
            $this->gears
        ));
    }
}

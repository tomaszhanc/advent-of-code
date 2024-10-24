<?php
declare(strict_types=1);

namespace Advent\Year2023\Day3\Model;

final readonly class Gear
{
    public function __construct(
        private int $partNumberA,
        private int $partNumberB
    ) {
    }

    public function gearRatio() : int
    {
        return $this->partNumberA * $this->partNumberB;
    }
}

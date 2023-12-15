<?php

declare(strict_types=1);

namespace AoC\Year2023\Day1;

use AoC\Year2023\Day1\CalibrationDocument\Line;

interface LineParser
{
    public function parse(string $line): Line;
}

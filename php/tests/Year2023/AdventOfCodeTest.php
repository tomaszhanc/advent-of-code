<?php

declare(strict_types=1);

namespace AoC\Year2023;

use PHPUnit\Framework\TestCase;

final class AdventOfCodeTest extends TestCase
{
    private AdventOfCode $adventOfCode;

    protected function setUp(): void
    {
        $this->adventOfCode = AdventOfCode::create();
    }

    public function test_day_one_calibrate_a_document(): void
    {
        $this->assertEquals(54504, $this->adventOfCode->calibrateDocument(__DIR__ . '/Resources/day1.txt'));
    }
}

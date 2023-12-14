<?php

declare(strict_types=1);

namespace AoC\Year2023;

use AoC\Year2023\Day2\Game\Cubes;
use AoC\Year2023\Day2\Game\CubesSet;
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
        $this->assertEquals(
            54504,
            $this->adventOfCode->calibrateDocument(__DIR__ . '/Resources/day1.txt')
        );
    }

    public function test_day_two_guess_number_of_cubes(): void
    {
        $this->assertEquals(
            2551,
            $this->adventOfCode->checkSumOfGameList(
                __DIR__ . '/Resources/day2.txt',
                new CubesSet(Cubes::red(12), Cubes::green(13), Cubes::blue(14))
            )
        );
    }
}

<?php

declare(strict_types=1);

namespace AoC\Year2023\Tests;

use AoC\Year2023\Day2;
use AoC\Year2023\Day2\Game\Cubes;
use AoC\Year2023\Day2\Game\CubesSet;
use PHPUnit\Framework\TestCase;

final class Day2Test extends TestCase
{
    private Day2 $day2;

    protected function setUp(): void
    {
        $this->day2 = Day2::create();
    }

    public function test_part_1_(): void
    {
        $this->assertEquals(
            2551,
            $this->day2->checkSumOfGameList(
                __DIR__ . '/Resources/day2.txt',
                CubesSet::of(Cubes::red(12), Cubes::green(13), Cubes::blue(14))
            )
        );
    }

    public function test_part_2_(): void
    {
        $this->assertEquals(
            2551,
            $this->day2->bla(
                __DIR__ . '/Resources/day2.txt',
                CubesSet::of(Cubes::red(12), Cubes::green(13), Cubes::blue(14))
            )
        );
    }
}

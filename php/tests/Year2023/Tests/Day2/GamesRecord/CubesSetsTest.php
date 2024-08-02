<?php

declare(strict_types=1);

namespace AoC\Year2023\Tests\Day2\GamesRecord;

use AoC\Year2023\Day2\GamesRecord\Cubes;
use AoC\Year2023\Day2\GamesRecord\CubesSet;
use AoC\Year2023\Day2\GamesRecord\CubesSets;
use PHPUnit\Framework\TestCase;

final class CubesSetsTest extends TestCase
{
    public function test_sums_powers_of_all_cubes_sets(): void
    {
        $cubesSets = CubesSets::create(
            CubesSet::of(Cubes::red(2), Cubes::blue(4)),
            CubesSet::of(Cubes::green(3), Cubes::red(7)),
            CubesSet::of(Cubes::green(9))
        );

        $this->assertSame(38, $cubesSets->sumOfAllPowers());
    }
}

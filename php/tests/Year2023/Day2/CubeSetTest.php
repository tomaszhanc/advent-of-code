<?php

declare(strict_types=1);

namespace AoC\Year2023\Day2;

use AoC\Year2023\Day2\Game\Cubes;
use AoC\Year2023\Day2\Game\CubesSet;
use PHPUnit\Framework\TestCase;

final class CubeSetTest extends TestCase
{
    /**
     * @dataProvider cube_set_with_greater_quantity
     */
    public function test_creates_new_cube_set_with_the_cube_of_greater_quantity(CubesSet $currentCubesSet, Cubes $cubes, CubesSet $expectedCubesSet): void
    {
        $this->assertEquals($expectedCubesSet, $currentCubesSet->withGreaterQuantity($cubes));
    }

    public static function cube_set_with_greater_quantity() : \Iterator
    {
        yield 'empty' => [
            CubesSet::of(),
            Cubes::blue(3),
            CubesSet::of(Cubes::blue(3))
        ];

        yield 'without given color' => [
            CubesSet::of(Cubes::blue(3)),
            Cubes::red(7),
            CubesSet::of(Cubes::blue(3), Cubes::red(7))
        ];

        yield 'new is smaller than the current' => [
            CubesSet::of(Cubes::blue(3), Cubes::red(7)),
            Cubes::red(4),
            CubesSet::of(Cubes::blue(3), Cubes::red(7))
        ];

        yield 'new is grater than the current' => [
            CubesSet::of(Cubes::blue(3), Cubes::red(7)),
            Cubes::red(9),
            CubesSet::of(Cubes::blue(3), Cubes::red(9))
        ];
    }

    /**
     * @dataProvider power_of_cubes_set
     */
    public function test_power_of_cubes_set(CubesSet $cubesSet, int $expectedPower): void
    {
        $this->assertEquals($expectedPower, $cubesSet->power());
    }

    public static function power_of_cubes_set() : \Iterator
    {
        yield [
            CubesSet::of(Cubes::red(4), Cubes::green(2), Cubes::blue(6)),
            48
        ];

        yield [
            CubesSet::of(Cubes::red(1), Cubes::green(3), Cubes::blue(4)),
            12
        ];

        yield [
            CubesSet::of(Cubes::red(20), Cubes::green(13), Cubes::blue(6)),
            1560
        ];

        yield [
            CubesSet::of(Cubes::red(14), Cubes::green(3), Cubes::blue(15)),
            630
        ];

        yield [
            CubesSet::of(Cubes::red(6), Cubes::green(3), Cubes::blue(2)),
            36
        ];
    }
}

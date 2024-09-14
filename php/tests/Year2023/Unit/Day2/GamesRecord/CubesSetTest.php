<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Unit\Day2\GamesRecord;

use Advent\Year2023\Day2\GamesRecord\Cubes;
use Advent\Year2023\Day2\GamesRecord\CubesSet;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class CubesSetTest extends TestCase
{
    #[Test] #[DataProvider('cubes_set_greater_quantity')]
    public function it_creates_new_cube_set_with_the_cube_of_greater_quantity(CubesSet $currentCubesSet, Cubes $cubes, CubesSet $expectedCubesSet): void
    {
        $this->assertEquals($expectedCubesSet, $currentCubesSet->withGreaterQuantity($cubes));
    }

    public static function cubes_set_greater_quantity(): iterable
    {
        yield 'empty' => [
            CubesSet::of(),
            Cubes::blue(3),
            CubesSet::of(Cubes::blue(3)),
        ];

        yield 'without given color' => [
            CubesSet::of(Cubes::blue(3)),
            Cubes::red(7),
            CubesSet::of(Cubes::blue(3), Cubes::red(7)),
        ];

        yield 'new is smaller than the current' => [
            CubesSet::of(Cubes::blue(3), Cubes::red(7)),
            Cubes::red(4),
            CubesSet::of(Cubes::blue(3), Cubes::red(7)),
        ];

        yield 'new is grater than the current' => [
            CubesSet::of(Cubes::blue(3), Cubes::red(7)),
            Cubes::red(9),
            CubesSet::of(Cubes::blue(3), Cubes::red(9)),
        ];
    }

    #[Test] #[DataProvider('cubes_set_power')]
    public function it_calculates_power_of_cubes_set(CubesSet $cubesSet, int $expectedPower): void
    {
        $this->assertEquals($expectedPower, $cubesSet->power());
    }

    public static function cubes_set_power(): iterable
    {
        yield [
            CubesSet::of(Cubes::red(4), Cubes::green(2), Cubes::blue(6)),
            48,
        ];

        yield [
            CubesSet::of(Cubes::red(1), Cubes::green(3), Cubes::blue(4)),
            12,
        ];

        yield [
            CubesSet::of(Cubes::red(20), Cubes::green(13), Cubes::blue(6)),
            1560,
        ];

        yield [
            CubesSet::of(Cubes::red(14), Cubes::green(3), Cubes::blue(15)),
            630,
        ];

        yield [
            CubesSet::of(Cubes::red(6), Cubes::green(3), Cubes::blue(2)),
            36,
        ];
    }
}

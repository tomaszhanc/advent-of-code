<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Unit\Day2\Model;

use Advent\Year2023\Day2\Model\Color;
use Advent\Year2023\Day2\Model\Cubes;
use Advent\Year2023\Day2\Model\CubesSet;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class CubesSetTest extends TestCase
{
    #[Test]
    public function it_gets_quantity_for_the_given_color(): void
    {
        $cubesSet = CubesSet::of(
            Cubes::red(4),
            Cubes::green(13),
        );

        $this->assertSame(4, $cubesSet->quantityOf(Color::RED));
        $this->assertSame(13, $cubesSet->quantityOf(Color::GREEN));
        $this->assertSame(0, $cubesSet->quantityOf(Color::BLUE));
    }

    #[Test]
    public function it_creates_new_cubes_set_with_replaced_cubes_of_the_given_color(): void
    {
        $emptyCubesSet = CubesSet::empty();
        $redCubesSet = $emptyCubesSet->replaceWith(Cubes::red(4));
        $redAndGreenCubesSet = $redCubesSet->replaceWith(Cubes::green(13));

        $this->assertSame(0, $emptyCubesSet->power());
        $this->assertSame(0, $emptyCubesSet->quantityOf(Color::RED));
        $this->assertSame(0, $emptyCubesSet->quantityOf(Color::GREEN));

        $this->assertSame(4, $redCubesSet->power());
        $this->assertSame(4, $redCubesSet->quantityOf(Color::RED));
        $this->assertSame(0, $redCubesSet->quantityOf(Color::GREEN));

        $this->assertSame(4 * 13, $redAndGreenCubesSet->power());
        $this->assertSame(4, $redAndGreenCubesSet->quantityOf(Color::RED));
        $this->assertSame(13, $redAndGreenCubesSet->quantityOf(Color::GREEN));
    }

    #[Test]
    #[DataProvider('scenarios_cubes_set_power')]
    public function it_calculates_power_of_cubes_set(int $expectedPower, Cubes ...$cubes): void
    {
        $this->assertEquals($expectedPower, CubesSet::of(...$cubes)->power());
    }

    public static function scenarios_cubes_set_power(): iterable
    {
        yield 'no cubes' => [
            0,
        ];

        yield 'single cubes' => [
            4,
            Cubes::red(4),
        ];

        yield 'multiple cubes' => [
            20 * 13 * 6,
            Cubes::red(20),
            Cubes::green(13),
            Cubes::blue(6),
        ];
    }
}

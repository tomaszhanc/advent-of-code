<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day6\Model;

use Advent\Shared\Range\Range;
use Advent\Year2023\Day6\Model\Race;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class RaceTest extends TestCase
{
    #[Test]
    #[DataProvider('races')]
    public function it_calculates_winning_time_range_for_charging_the_boat(Race $race, Range $winningChargingRange, int $waysToWin): void
    {
        $this->assertEquals($winningChargingRange, $race->winningTimeRangeForChargingTheBoat());
        $this->assertEquals($waysToWin, $race->waysToWin());
    }

    public static function races(): iterable
    {
        yield [
            new Race(time: 7, recordDistance: 9),
            new Range(2, 5),
            4, // 2, 3, 4, 5
        ];

        yield [
            new Race(time: 15, recordDistance: 40),
            new Range(4, 11),
            8, // 4, 5, 6, 7, 8, 9, 10, 11
        ];

        yield [
            new Race(time: 30, recordDistance: 200),
            new Range(11, 19),
            9,
        ];
    }
}

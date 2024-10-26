<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day5\Model;

use Advent\Year2023\Day5\Model\Almanac\Map;
use Advent\Year2023\Day5\Model\Almanac\MapRange;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class MapTest extends TestCase
{
    #[Test]
    public function it_returns_destination_number_for_source_number(): void
    {
        $map = new Map(
            new MapRange(destinationRangeStart: 50, sourceRangeStart: 98, rangeLength: 2),
            new MapRange(destinationRangeStart: 52, sourceRangeStart: 50, rangeLength: 48)
        );

        // outside of ranges
        $this->assertEquals(0, $map->destinationNumber(0));
        $this->assertEquals(49, $map->destinationNumber(49));

        // part of the 2nd range
        $this->assertEquals(52, $map->destinationNumber(50));
        $this->assertEquals(53, $map->destinationNumber(51));
        $this->assertEquals(92, $map->destinationNumber(90));
        $this->assertEquals(99, $map->destinationNumber(97));

        // part of the 1st range
        $this->assertEquals(50, $map->destinationNumber(98));
        $this->assertEquals(51, $map->destinationNumber(99));

        // outside of ranges
        $this->assertEquals(100, $map->destinationNumber(100));
        $this->assertEquals(999, $map->destinationNumber(999));
    }
}

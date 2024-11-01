<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day5\Model;

use Advent\Shared\Range\Range;
use Advent\Year2023\Day5\Model\Almanac\MapRule;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class MapRangeTest extends TestCase
{
    #[Test]
    public function it_returns_destination_and_source_ranges(): void
    {
        $range = new MapRule(sourceRangeStart: 50, destinationRangeStart: 52, rangeLength: 48);

        $this->assertEquals(new Range(50, 97), $range->sourceRange());
    }

    #[Test]
    public function it_returns_destination_number_for_source_number(): void
    {
        $range = new MapRule(sourceRangeStart: 50, destinationRangeStart: 52, rangeLength: 48);

        $this->assertEquals(52, $range->destinationNumber(50));
        $this->assertEquals(53, $range->destinationNumber(51));
        $this->assertEquals(98, $range->destinationNumber(96));
        $this->assertEquals(99, $range->destinationNumber(97));

        $this->assertFalse($range->isFor(49));
        $this->assertFalse($range->isFor(98));
    }
}

<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day5\Model;

use Advent\Year2023\Day5\Model\Almanac\MapRange;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class MapRangeTest extends TestCase
{
    #[Test]
    public function it_returns_destination_number_for_source_number(): void
    {
        $range = new MapRange(destinationRangeStart: 50, sourceRangeStart: 98, rangeLength: 2);

        $this->assertEquals(50, $range->destinationNumber(98));
        $this->assertEquals(51, $range->destinationNumber(99));

        $this->assertFalse($range->isFor(20));
        $this->assertFalse($range->isFor(97));
        $this->assertFalse($range->isFor(100));
    }
}

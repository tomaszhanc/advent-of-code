<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day5\Model;

use Advent\Year2023\Day5\Model\Almanac\SeedRange;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class SeedRangeTest extends TestCase
{
    #[Test]
    public function it_creates_seed_range(): void
    {
        $range = new SeedRange(start: 79, length: 14);

        $this->assertEquals(
            [79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92],
            iterator_to_array($range->seeds())
        );
    }
}

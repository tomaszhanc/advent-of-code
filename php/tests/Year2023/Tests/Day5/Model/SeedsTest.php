<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day5\Model;

use Advent\Year2023\Day5\Model\Almanac\SeedRange;
use Advent\Year2023\Day5\Model\Almanac\Seeds;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class SeedsTest extends TestCase
{
    #[Test]
    public function it_returns_seeds_as_seeds(): void
    {
        $seeds = new Seeds(79, 14, 55, 13);

        $this->assertEquals(
            [79, 14, 55, 13],
            iterator_to_array($seeds->asSeeds())
        );
    }

    #[Test]
    public function it_returns_seeds_as_ranges(): void
    {
        $seeds = new Seeds(79, 14, 55, 13);

        $this->assertEquals(
            [
                new SeedRange(79, 14),
                new SeedRange(55, 13),
            ],
            iterator_to_array($seeds->asRanges())
        );
    }
}

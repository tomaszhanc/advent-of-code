<?php

declare(strict_types=1);

namespace Advent\Tests\Shared\Unit\Range;

use Advent\Shared\Range\Range;
use Advent\Shared\Range\Ranges;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class RangesTest extends TestCase
{
    #[Test]
    #[DataProvider('scenarios_consolidate')]
    public function it_consolidates_contiguous_and_overlapped_ranges(Ranges $origin, Ranges $consolidated): void
    {
        $this->assertEqualsCanonicalizing($consolidated, $origin->consolidate());
    }

    public static function scenarios_consolidate(): iterable
    {
        yield [
             new Ranges(
                 new Range(10, 40),
                 new Range(20, 60),
                 new Range(10, 15),
             ),
            new Ranges(
                new Range(10, 60),
            ),
        ];

        yield [
             new Ranges(
                 new Range(10, 40),
                 new Range(41, 60),
                 new Range(62, 70),
             ),
            new Ranges(
                new Range(10, 60),
                new Range(62, 70),
            ),
        ];
    }
}

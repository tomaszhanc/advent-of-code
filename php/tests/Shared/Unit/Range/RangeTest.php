<?php

declare(strict_types=1);

namespace Advent\Tests\Shared\Unit\Range;

use Advent\Shared\Range\Range;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class RangeTest extends TestCase
{
    #[Test]
    public function it_creates_range_of_given_length(): void
    {
        $this->assertEquals(
            new Range(79, 92),
            Range::ofLength(start: 79, length: 14)
        );
    }

    #[Test]
    public function it_returns_all_numbers_in_a_range(): void
    {
        $range = new Range(79, 92);

        $this->assertEquals(
            [79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92],
            iterator_to_array($range)
        );
    }

    #[Test]
    #[DataProvider('scenarios_intersection')]
    public function it_finds_intersection_between_two_ranges(Range $rangeA, Range $rangeB, ?Range $intersection): void
    {
        $this->assertEquals($intersection, $rangeA->intersection($rangeB));
    }

    public static function scenarios_intersection(): iterable
    {
        yield 'when B starts and ends before A' => [
            'rangeA' => new Range(start: 20, end: 45),
            'rangeB' => new Range(start: 0, end: 15),
            'intersection' => null,
        ];

        yield 'when B starts before A and ends inside A' => [
            'rangeA' => new Range(start: 20, end: 45),
            'rangeB' => new Range(start: 15, end: 35),
            'intersection' => new Range(start: 20, end: 35),
        ];

        yield 'when B starts before A and ends after A' => [
            'rangeA' => new Range(start: 20, end: 45),
            'rangeB' => new Range(start: 15, end: 50),
            'intersection' => new Range(start: 20, end: 45),
        ];

        yield 'when B starts and ends inside A' => [
            'rangeA' => new Range(start: 20, end: 45),
            'rangeB' => new Range(start: 25, end: 35),
            'intersection' => new Range(start: 25, end: 35),
        ];

        yield 'when B equals A' => [
            'rangeA' => new Range(start: 20, end: 45),
            'rangeB' => new Range(start: 20, end: 45),
            'intersection' => new Range(start: 20, end: 45),
        ];

        yield 'when B starts inside A and ends after A' => [
            'rangeA' => new Range(start: 20, end: 45),
            'rangeB' => new Range(start: 25, end: 50),
            'intersection' => new Range(start: 25, end: 45),
        ];

        yield 'when B starts and ends after A' => [
            'rangeA' => new Range(start: 20, end: 45),
            'rangeB' => new Range(start: 50, end: 65),
            'intersection' => null,
        ];
    }

    #[Test]
    #[DataProvider('scenarios_difference')]
    public function it_finds_difference_between_two_ranges(Range $rangeA, Range $rangeB, array $difference): void
    {
        $this->assertEquals($difference, $rangeA->difference($rangeB));
    }

    public static function scenarios_difference(): iterable
    {
        yield 'when B starts and ends before A' => [
            'rangeA' => new Range(start: 20, end: 45),
            'rangeB' => new Range(start: 0, end: 15),
            'difference' => [
                new Range(start: 20, end: 45),
            ],
        ];

        yield 'when B starts before A and ends inside A' => [
            'rangeA' => new Range(start: 20, end: 45),
            'rangeB' => new Range(start: 15, end: 35),
            'difference' => [
                new Range(start: 36, end: 45),
            ],
        ];

        yield 'when B starts before A and ends after A' => [
            'rangeA' => new Range(start: 20, end: 45),
            'rangeB' => new Range(start: 15, end: 50),
            'difference' => [],
        ];

        yield 'when B starts and ends inside A' => [
            'rangeA' => new Range(start: 20, end: 45),
            'rangeB' => new Range(start: 25, end: 35),
            'difference' => [
                new Range(start: 20, end: 24),
                new Range(start: 36, end: 45),
            ],
        ];

        yield 'when B equals A' => [
            'rangeA' => new Range(start: 20, end: 45),
            'rangeB' => new Range(start: 20, end: 45),
            'difference' => [],
        ];

        yield 'when B starts inside A and ends after A' => [
            'rangeA' => new Range(start: 20, end: 45),
            'rangeB' => new Range(start: 25, end: 50),
            'difference' => [
                new Range(start: 20, end: 24),
            ],
        ];

        yield 'when B starts and ends after A' => [
            'rangeA' => new Range(start: 20, end: 45),
            'rangeB' => new Range(start: 50, end: 65),
            'difference' => [
                new Range(start: 20, end: 45),
            ],
        ];
    }
}

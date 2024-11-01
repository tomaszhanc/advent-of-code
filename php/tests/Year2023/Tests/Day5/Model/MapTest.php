<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day5\Model;

use Advent\Shared\Range\Range;
use Advent\Shared\Range\Ranges;
use Advent\Year2023\Day5\Model\Almanac\Map;
use Advent\Year2023\Day5\Model\Almanac\MapRule;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class MapTest extends TestCase
{
    #[Test]
    public function it_returns_destination_number_for_source_number(): void
    {
        $map = new Map(
            new MapRule(sourceRangeStart: 98, destinationRangeStart: 50, rangeLength: 2),
            new MapRule(sourceRangeStart: 50, destinationRangeStart: 52, rangeLength: 48)
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

    #[Test]
    #[DataProvider('ranges')]
    public function it_returns_destination_ranges_for_input_range_adjusted_to_source_ranges(Map $map, Range $input, Ranges $expectedDestination): void
    {
        $this->assertEqualsCanonicalizing(
            $expectedDestination,
            $map->destinationNumberRanges(new Ranges($input))
        );
    }

    public static function ranges(): iterable
    {
        $map = new Map(
            // source: 30-49, destination: 80-99
            new MapRule(sourceRangeStart: 30, destinationRangeStart: 80, rangeLength: 20),
            // source: 50-64, destination: 10-24
            new MapRule(sourceRangeStart: 50, destinationRangeStart: 10, rangeLength: 15)
        );

        yield 'when INPUT starts and ends before the SOURCE range' => [
            $map, // {30-49} => {80-99}, {50-64} => {10-24}
            'input' => new Range(10, 20),
            'expectedDestination' => new Ranges(
                new Range(10, 20)
            ),
        ];

        yield 'when INPUT starts before first SOURCE range and ends inside first SOURCE range' => [
            $map, // {30-49} => {80-99}, {50-64} => {10-24}
            'input' => new Range(10, 45),
            'expectedDestination' => new Ranges(
                new Range(10, 29),
                new Range(80, 95),
            ),
        ];

        yield 'when INPUT starts before first SOURCE range and ends inside second SOURCE range' => [
            $map, // {30-49} => {80-99}, {50-64} => {10-24}
            'input' => new Range(10, 55),
            'expectedDestination' => new Ranges(
                new Range(10, 29),
                new Range(80, 99),
            ),
        ];

        yield 'when INPUT starts before SOURCE range and ends after SOURCE range' => [
            $map, // {30-49} => {80-99}, {50-64} => {10-24}
            'input' => new Range(10, 70),
            'expectedDestination' => new Ranges(
                new Range(10, 29),
                new Range(80, 99),
                new Range(65, 70),
            ),
        ];

        yield 'when INPUT starts and ends inside first SOURCE range' => [
            $map, // {30-49} => {80-99}, {50-64} => {10-24}
            'input' => new Range(35, 45),
            'expectedDestination' => new Ranges(
                new Range(85, 95)
            ),
        ];

        yield 'when INPUT starts and ends inside second SOURCE range' => [
            $map, // {30-49} => {80-99}, {50-64} => {10-24}
            'input' => new Range(55, 61),
            'expectedDestination' => new Ranges(
                new Range(15, 21),
            ),
        ];

        yield 'when INPUT starts inside first SOURCE range and ends inside second SOURCE range' => [
            $map, // {30-49} => {80-99}, {50-64} => {10-24}
            'input' => new Range(35, 55),
            'expectedDestination' => new Ranges(
                new Range(85, 99),
                new Range(10, 15),
            ),
        ];

        yield 'when INPUT starts inside first SOURCE range and ends after second SOURCE range' => [
            $map, // {30-49} => {80-99}, {50-64} => {10-24}
            'input' => new Range(35, 70),
            'expectedDestination' => new Ranges(
                new Range(85, 99),
                new Range(10, 24),
                new Range(65, 70),
            ),
        ];

        yield 'when INPUT starts and ends after second SOURCE range' => [
            $map, // {30-49} => {80-99}, {50-64} => {10-24}
            'input' => new Range(70, 80),
            'expectedDestination' => new Ranges(
                new Range(70, 80)
            ),
        ];
    }
}

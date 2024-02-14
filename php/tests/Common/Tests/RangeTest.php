<?php

declare(strict_types=1);

namespace AoC\Common\Tests;

use AoC\Common\Cell;
use AoC\Common\Range;
use PHPUnit\Framework\TestCase;

final class RangeTest extends TestCase
{
    public function test_start_column_must_be_less_than_equal_end_column(): void
    {
        $this->expectExceptionMessage('Start column must be less than or equal to End column');

        new Range(
            new Cell(7, 3),
            new Cell(2, 3)
        );
    }

    public function test_diagonal_ranges_are_not_supported(): void
    {
        $this->expectExceptionMessage('Diagonal ranges are not supported');

        new Range(
            new Cell(2, 3),
            new Cell(7, 5)
        );
    }

    /**
     * @dataProvider scenarios
     */
    public function test_is_adjacent(Range $range, Cell $point, bool $isAdjacent): void
    {
        $this->assertSame($isAdjacent, $range->isAdjacentTo($point));
    }

    public static function scenarios() : iterable
    {
        return [
            ...self::scenarios_for_horizontal_line(),
            ...self::scenarios_for_vertical_line()
        ];
    }

    public static function scenarios_for_horizontal_line() : iterable
    {
        $range = new Range(
            new Cell(2, 3),
            new Cell(7, 3)
        );

        // Row -2
        yield 'horizontal - column:0, row:1' => [$range, new Cell(0, 1), false];
        yield 'horizontal - column:1, row:1' => [$range, new Cell(1, 1), false];
        yield 'horizontal - column:2, row:1' => [$range, new Cell(2, 1), false];
        yield 'horizontal - column:3, row:1' => [$range, new Cell(3, 1), false];
        yield 'horizontal - column:4, row:1' => [$range, new Cell(4, 1), false];
        yield 'horizontal - column:5, row:1' => [$range, new Cell(5, 1), false];
        yield 'horizontal - column:6, row:1' => [$range, new Cell(6, 1), false];
        yield 'horizontal - column:7, row:1' => [$range, new Cell(7, 1), false];
        yield 'horizontal - column:8, row:1' => [$range, new Cell(8, 1), false];
        yield 'horizontal - column:9, row:1' => [$range, new Cell(9, 1), false];

        // Row -1
        yield 'horizontal - column:0, row:2' => [$range, new Cell(0, 2), false];
        yield 'horizontal - column:1, row:2' => [$range, new Cell(1, 2), true];
        yield 'horizontal - column:2, row:2' => [$range, new Cell(2, 2), true];
        yield 'horizontal - column:3, row:2' => [$range, new Cell(3, 2), true];
        yield 'horizontal - column:4, row:2' => [$range, new Cell(4, 2), true];
        yield 'horizontal - column:5, row:2' => [$range, new Cell(5, 2), true];
        yield 'horizontal - column:6, row:2' => [$range, new Cell(6, 2), true];
        yield 'horizontal - column:7, row:2' => [$range, new Cell(7, 2), true];
        yield 'horizontal - column:8, row:2' => [$range, new Cell(8, 2), true];
        yield 'horizontal - column:9, row:2' => [$range, new Cell(9, 2), false];

        // The Same Row
        yield 'horizontal - column:0, row:3' => [$range, new Cell(0, 3), false];
        yield 'horizontal - column:1, row:3' => [$range, new Cell(1, 3), true];
        yield 'horizontal - column:2, row:3' => [$range, new Cell(2, 3), false];
        yield 'horizontal - column:3, row:3' => [$range, new Cell(3, 3), false];
        yield 'horizontal - column:4, row:3' => [$range, new Cell(4, 3), false];
        yield 'horizontal - column:5, row:3' => [$range, new Cell(5, 3), false];
        yield 'horizontal - column:6, row:3' => [$range, new Cell(6, 3), false];
        yield 'horizontal - column:7, row:3' => [$range, new Cell(7, 3), false];
        yield 'horizontal - column:8, row:3' => [$range, new Cell(8, 3), true];
        yield 'horizontal - column:9, row:3' => [$range, new Cell(9, 3), false];

        // Row +1
        yield 'horizontal - column:0, row:4' => [$range, new Cell(0, 4), false];
        yield 'horizontal - column:1, row:4' => [$range, new Cell(1, 4), true];
        yield 'horizontal - column:2, row:4' => [$range, new Cell(2, 4), true];
        yield 'horizontal - column:3, row:4' => [$range, new Cell(3, 4), true];
        yield 'horizontal - column:4, row:4' => [$range, new Cell(4, 4), true];
        yield 'horizontal - column:5, row:4' => [$range, new Cell(5, 4), true];
        yield 'horizontal - column:6, row:4' => [$range, new Cell(6, 4), true];
        yield 'horizontal - column:7, row:4' => [$range, new Cell(7, 4), true];
        yield 'horizontal - column:8, row:4' => [$range, new Cell(8, 4), true];
        yield 'horizontal - column:9, row:4' => [$range, new Cell(9, 4), false];

        // Row +2
        yield 'horizontal - column:0, row:5' => [$range, new Cell(0, 5), false];
        yield 'horizontal - column:1, row:5' => [$range, new Cell(1, 5), false];
        yield 'horizontal - column:2, row:5' => [$range, new Cell(2, 5), false];
        yield 'horizontal - column:3, row:5' => [$range, new Cell(3, 5), false];
        yield 'horizontal - column:4, row:5' => [$range, new Cell(4, 5), false];
        yield 'horizontal - column:5, row:5' => [$range, new Cell(5, 5), false];
        yield 'horizontal - column:6, row:5' => [$range, new Cell(6, 5), false];
        yield 'horizontal - column:7, row:5' => [$range, new Cell(7, 5), false];
        yield 'horizontal - column:8, row:5' => [$range, new Cell(8, 5), false];
        yield 'horizontal - column:9, row:5' => [$range, new Cell(9, 5), false];
    }

    public static function scenarios_for_vertical_line() : iterable
    {
        $range = new Range(
            new Cell(4, 2),
            new Cell(4, 7)
        );

        // Column -2
        yield 'vertical - column:2, row:0' => [$range, new Cell(2, 0), false];
        yield 'vertical - column:2, row:1' => [$range, new Cell(2, 1), false];
        yield 'vertical - column:2, row:2' => [$range, new Cell(2, 2), false];
        yield 'vertical - column:2, row:3' => [$range, new Cell(2, 3), false];
        yield 'vertical - column:2, row:4' => [$range, new Cell(2, 4), false];
        yield 'vertical - column:2, row:5' => [$range, new Cell(2, 5), false];
        yield 'vertical - column:2, row:6' => [$range, new Cell(2, 6), false];
        yield 'vertical - column:2, row:7' => [$range, new Cell(2, 7), false];
        yield 'vertical - column:2, row:8' => [$range, new Cell(2, 8), false];
        yield 'vertical - column:2, row:9' => [$range, new Cell(2, 9), false];

        // Column -1
        yield 'vertical - column:3, row:0' => [$range, new Cell(3, 0), false];
        yield 'vertical - column:3, row:1' => [$range, new Cell(3, 1), true];
        yield 'vertical - column:3, row:2' => [$range, new Cell(3, 2), true];
        yield 'vertical - column:3, row:3' => [$range, new Cell(3, 3), true];
        yield 'vertical - column:3, row:4' => [$range, new Cell(3, 4), true];
        yield 'vertical - column:3, row:5' => [$range, new Cell(3, 5), true];
        yield 'vertical - column:3, row:6' => [$range, new Cell(3, 6), true];
        yield 'vertical - column:3, row:7' => [$range, new Cell(3, 7), true];
        yield 'vertical - column:3, row:8' => [$range, new Cell(3, 8), true];
        yield 'vertical - column:3, row:9' => [$range, new Cell(3, 9), false];

        // The Same Column
        yield 'vertical - column:4, row:0' => [$range, new Cell(4, 0), false];
        yield 'vertical - column:4, row:1' => [$range, new Cell(4, 1), true];
        yield 'vertical - column:4, row:2' => [$range, new Cell(4, 2), false];
        yield 'vertical - column:4, row:3' => [$range, new Cell(4, 3), false];
        yield 'vertical - column:4, row:4' => [$range, new Cell(4, 4), false];
        yield 'vertical - column:4, row:5' => [$range, new Cell(4, 5), false];
        yield 'vertical - column:4, row:6' => [$range, new Cell(4, 6), false];
        yield 'vertical - column:4, row:7' => [$range, new Cell(4, 7), false];
        yield 'vertical - column:4, row:8' => [$range, new Cell(4, 8), true];
        yield 'vertical - column:4, row:9' => [$range, new Cell(4, 9), false];

        // Column +1
        yield 'vertical - column:5, row:0' => [$range, new Cell(5, 0), false];
        yield 'vertical - column:5, row:1' => [$range, new Cell(5, 1), true];
        yield 'vertical - column:5, row:2' => [$range, new Cell(5, 2), true];
        yield 'vertical - column:5, row:3' => [$range, new Cell(5, 3), true];
        yield 'vertical - column:5, row:4' => [$range, new Cell(5, 4), true];
        yield 'vertical - column:5, row:5' => [$range, new Cell(5, 5), true];
        yield 'vertical - column:5, row:6' => [$range, new Cell(5, 6), true];
        yield 'vertical - column:5, row:7' => [$range, new Cell(5, 7), true];
        yield 'vertical - column:5, row:8' => [$range, new Cell(5, 8), true];
        yield 'vertical - column:5, row:9' => [$range, new Cell(5, 9), false];

        // Column +2
        yield 'vertical - column:6, row:0' => [$range, new Cell(6, 0), false];
        yield 'vertical - column:6, row:1' => [$range, new Cell(6, 1), false];
        yield 'vertical - column:6, row:2' => [$range, new Cell(6, 2), false];
        yield 'vertical - column:6, row:3' => [$range, new Cell(6, 3), false];
        yield 'vertical - column:6, row:4' => [$range, new Cell(6, 4), false];
        yield 'vertical - column:6, row:5' => [$range, new Cell(6, 5), false];
        yield 'vertical - column:6, row:6' => [$range, new Cell(6, 6), false];
        yield 'vertical - column:6, row:7' => [$range, new Cell(6, 7), false];
        yield 'vertical - column:6, row:8' => [$range, new Cell(6, 8), false];
        yield 'vertical - column:6, row:9' => [$range, new Cell(6, 9), false];
    }
}

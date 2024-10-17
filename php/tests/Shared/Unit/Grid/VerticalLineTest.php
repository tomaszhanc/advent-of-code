<?php

declare(strict_types=1);

namespace Advent\Tests\Shared\Unit\Grid;

use Advent\Shared\Grid\Cell;
use Advent\Shared\Grid\Line\VerticalLine;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class VerticalLineTest extends TestCase
{
    #[Test]
    public function it_ensures_that_vertical_line_has_cells_in_the_same_column(): void
    {
        $startCell = new Cell(3, 10);
        $endCell = new Cell(7, 10);

        $this->expectExceptionMessage('Vertical line must have cells in the same column');

        new VerticalLine($startCell, $endCell);
    }

    #[Test]
    public function it_ensures_that_vertical_line_has_two_different_cells_as_start_and_end(): void
    {
        $cell = new Cell(7, 3);

        $this->expectExceptionMessage('Vertical line cannot start and end on the same cell');

        new VerticalLine($cell, $cell);
    }

    #[Test]
    public function it_ensures_that_vertical_line_has_start_cell_before_end_cell(): void
    {
        $startCell = new Cell(2, 7);
        $endCell = new Cell(2, 3);

        $this->expectExceptionMessage('Start cell must be before end cell');

        new VerticalLine($startCell, $endCell);
    }

    #[Test]
    public function it_creates_vertical_line_of_a_given_length(): void
    {
        $this->assertEquals(
            VerticalLine::ofLength(
                new Cell(1, 5),
                length: 10
            ),
            new VerticalLine(
                new Cell(1, 5),
                new Cell(1, 15)
            ),
        );
    }

    #[Test]
    #[DataProvider('scenarios')]
    public function it_is_adjacent(VerticalLine $line, Cell $point, bool $isAdjacent): void
    {
        $this->assertSame($isAdjacent, $line->isAdjacentTo($point));
    }

    public static function scenarios(): iterable
    {
        $line = new VerticalLine(
            new Cell(4, 2),
            new Cell(4, 7)
        );

        // Column -2
        yield 'vertical - column:2, row:0' => [$line, new Cell(2, 0), false];
        yield 'vertical - column:2, row:1' => [$line, new Cell(2, 1), false];
        yield 'vertical - column:2, row:2' => [$line, new Cell(2, 2), false];
        yield 'vertical - column:2, row:3' => [$line, new Cell(2, 3), false];
        yield 'vertical - column:2, row:4' => [$line, new Cell(2, 4), false];
        yield 'vertical - column:2, row:5' => [$line, new Cell(2, 5), false];
        yield 'vertical - column:2, row:6' => [$line, new Cell(2, 6), false];
        yield 'vertical - column:2, row:7' => [$line, new Cell(2, 7), false];
        yield 'vertical - column:2, row:8' => [$line, new Cell(2, 8), false];
        yield 'vertical - column:2, row:9' => [$line, new Cell(2, 9), false];

        // Column -1
        yield 'vertical - column:3, row:0' => [$line, new Cell(3, 0), false];
        yield 'vertical - column:3, row:1' => [$line, new Cell(3, 1), true];
        yield 'vertical - column:3, row:2' => [$line, new Cell(3, 2), true];
        yield 'vertical - column:3, row:3' => [$line, new Cell(3, 3), true];
        yield 'vertical - column:3, row:4' => [$line, new Cell(3, 4), true];
        yield 'vertical - column:3, row:5' => [$line, new Cell(3, 5), true];
        yield 'vertical - column:3, row:6' => [$line, new Cell(3, 6), true];
        yield 'vertical - column:3, row:7' => [$line, new Cell(3, 7), true];
        yield 'vertical - column:3, row:8' => [$line, new Cell(3, 8), true];
        yield 'vertical - column:3, row:9' => [$line, new Cell(3, 9), false];

        // The Same Column
        yield 'vertical - column:4, row:0' => [$line, new Cell(4, 0), false];
        yield 'vertical - column:4, row:1' => [$line, new Cell(4, 1), true];
        yield 'vertical - column:4, row:2' => [$line, new Cell(4, 2), false];
        yield 'vertical - column:4, row:3' => [$line, new Cell(4, 3), false];
        yield 'vertical - column:4, row:4' => [$line, new Cell(4, 4), false];
        yield 'vertical - column:4, row:5' => [$line, new Cell(4, 5), false];
        yield 'vertical - column:4, row:6' => [$line, new Cell(4, 6), false];
        yield 'vertical - column:4, row:7' => [$line, new Cell(4, 7), false];
        yield 'vertical - column:4, row:8' => [$line, new Cell(4, 8), true];
        yield 'vertical - column:4, row:9' => [$line, new Cell(4, 9), false];

        // Column +1
        yield 'vertical - column:5, row:0' => [$line, new Cell(5, 0), false];
        yield 'vertical - column:5, row:1' => [$line, new Cell(5, 1), true];
        yield 'vertical - column:5, row:2' => [$line, new Cell(5, 2), true];
        yield 'vertical - column:5, row:3' => [$line, new Cell(5, 3), true];
        yield 'vertical - column:5, row:4' => [$line, new Cell(5, 4), true];
        yield 'vertical - column:5, row:5' => [$line, new Cell(5, 5), true];
        yield 'vertical - column:5, row:6' => [$line, new Cell(5, 6), true];
        yield 'vertical - column:5, row:7' => [$line, new Cell(5, 7), true];
        yield 'vertical - column:5, row:8' => [$line, new Cell(5, 8), true];
        yield 'vertical - column:5, row:9' => [$line, new Cell(5, 9), false];

        // Column +2
        yield 'vertical - column:6, row:0' => [$line, new Cell(6, 0), false];
        yield 'vertical - column:6, row:1' => [$line, new Cell(6, 1), false];
        yield 'vertical - column:6, row:2' => [$line, new Cell(6, 2), false];
        yield 'vertical - column:6, row:3' => [$line, new Cell(6, 3), false];
        yield 'vertical - column:6, row:4' => [$line, new Cell(6, 4), false];
        yield 'vertical - column:6, row:5' => [$line, new Cell(6, 5), false];
        yield 'vertical - column:6, row:6' => [$line, new Cell(6, 6), false];
        yield 'vertical - column:6, row:7' => [$line, new Cell(6, 7), false];
        yield 'vertical - column:6, row:8' => [$line, new Cell(6, 8), false];
        yield 'vertical - column:6, row:9' => [$line, new Cell(6, 9), false];
    }
}

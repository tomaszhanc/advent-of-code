<?php

declare(strict_types=1);

namespace Advent\Tests\Shared\Unit\Grid;

use Advent\Shared\Grid\Location;
use Advent\Shared\Grid\Line\HorizontalLine;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class HorizontalLineTest extends TestCase
{
    #[Test]
    public function it_ensures_that_horizontal_line_has_cells_in_the_same_row(): void
    {
        $startCell = new Location(7, 3);
        $endCell = new Location(7, 10);

        $this->expectExceptionMessage('Horizontal line must have cells in the same row');

        new HorizontalLine($startCell, $endCell);
    }

    #[Test]
    public function it_ensures_that_horizontal_line_has_two_different_cells_as_start_and_end(): void
    {
        $cell = new Location(7, 3);

        $this->expectExceptionMessage('Horizontal line cannot start and end on the same cell');

        new HorizontalLine($cell, $cell);
    }

    #[Test]
    public function it_ensures_that_horizontal_line_has_start_cell_before_end_cell(): void
    {
        $startCell = new Location(7, 3);
        $endCell = new Location(2, 3);

        $this->expectExceptionMessage('Start cell must be before end cell');

        new HorizontalLine($startCell, $endCell);
    }

    #[Test]
    public function it_creates_horizontal_line_of_a_given_length(): void
    {
        $this->assertEquals(
            HorizontalLine::ofLength(
                new Location(1, 5),
                length: 10
            ),
            new HorizontalLine(
                new Location(1, 5),
                new Location(10, 5)
            ),
        );
    }

    #[Test]
    public function it_return_all_cells_for_the_line(): void
    {
        $line = new HorizontalLine(
            new Location(1, 5),
            new Location(5, 5)
        );

        $this->assertEquals(
            [
                new Location(1, 5),
                new Location(2, 5),
                new Location(3, 5),
                new Location(4, 5),
                new Location(5, 5),
            ],
            iterator_to_array($line->cells())
        );
    }

    #[Test]
    #[DataProvider('scenarios')]
    public function it_is_adjacent(HorizontalLine $line, Location $point, bool $isAdjacent): void
    {
        $this->assertSame($isAdjacent, $line->isAdjacentTo($point), $isAdjacent ? 'Cell should be adjacent, but is not' : 'Cell should not be adjacent, but it is');
    }

    public static function scenarios(): iterable
    {
        $line = new HorizontalLine(
            new Location(2, 3),
            new Location(7, 3)
        );

        // Row -2
        yield 'horizontal - column:0, row:1' => [$line, new Location(0, 1), false];
        yield 'horizontal - column:1, row:1' => [$line, new Location(1, 1), false];
        yield 'horizontal - column:2, row:1' => [$line, new Location(2, 1), false];
        yield 'horizontal - column:3, row:1' => [$line, new Location(3, 1), false];
        yield 'horizontal - column:4, row:1' => [$line, new Location(4, 1), false];
        yield 'horizontal - column:5, row:1' => [$line, new Location(5, 1), false];
        yield 'horizontal - column:6, row:1' => [$line, new Location(6, 1), false];
        yield 'horizontal - column:7, row:1' => [$line, new Location(7, 1), false];
        yield 'horizontal - column:8, row:1' => [$line, new Location(8, 1), false];
        yield 'horizontal - column:9, row:1' => [$line, new Location(9, 1), false];

        // Row -1
        yield 'horizontal - column:0, row:2' => [$line, new Location(0, 2), false];
        yield 'horizontal - column:1, row:2' => [$line, new Location(1, 2), true];
        yield 'horizontal - column:2, row:2' => [$line, new Location(2, 2), true];
        yield 'horizontal - column:3, row:2' => [$line, new Location(3, 2), true];
        yield 'horizontal - column:4, row:2' => [$line, new Location(4, 2), true];
        yield 'horizontal - column:5, row:2' => [$line, new Location(5, 2), true];
        yield 'horizontal - column:6, row:2' => [$line, new Location(6, 2), true];
        yield 'horizontal - column:7, row:2' => [$line, new Location(7, 2), true];
        yield 'horizontal - column:8, row:2' => [$line, new Location(8, 2), true];
        yield 'horizontal - column:9, row:2' => [$line, new Location(9, 2), false];

        // The Same Row
        yield 'horizontal - column:0, row:3' => [$line, new Location(0, 3), false];
        yield 'horizontal - column:1, row:3' => [$line, new Location(1, 3), true];
        yield 'horizontal - column:2, row:3' => [$line, new Location(2, 3), false];
        yield 'horizontal - column:3, row:3' => [$line, new Location(3, 3), false];
        yield 'horizontal - column:4, row:3' => [$line, new Location(4, 3), false];
        yield 'horizontal - column:5, row:3' => [$line, new Location(5, 3), false];
        yield 'horizontal - column:6, row:3' => [$line, new Location(6, 3), false];
        yield 'horizontal - column:7, row:3' => [$line, new Location(7, 3), false];
        yield 'horizontal - column:8, row:3' => [$line, new Location(8, 3), true];
        yield 'horizontal - column:9, row:3' => [$line, new Location(9, 3), false];

        // Row +1
        yield 'horizontal - column:0, row:4' => [$line, new Location(0, 4), false];
        yield 'horizontal - column:1, row:4' => [$line, new Location(1, 4), true];
        yield 'horizontal - column:2, row:4' => [$line, new Location(2, 4), true];
        yield 'horizontal - column:3, row:4' => [$line, new Location(3, 4), true];
        yield 'horizontal - column:4, row:4' => [$line, new Location(4, 4), true];
        yield 'horizontal - column:5, row:4' => [$line, new Location(5, 4), true];
        yield 'horizontal - column:6, row:4' => [$line, new Location(6, 4), true];
        yield 'horizontal - column:7, row:4' => [$line, new Location(7, 4), true];
        yield 'horizontal - column:8, row:4' => [$line, new Location(8, 4), true];
        yield 'horizontal - column:9, row:4' => [$line, new Location(9, 4), false];

        // Row +2
        yield 'horizontal - column:0, row:5' => [$line, new Location(0, 5), false];
        yield 'horizontal - column:1, row:5' => [$line, new Location(1, 5), false];
        yield 'horizontal - column:2, row:5' => [$line, new Location(2, 5), false];
        yield 'horizontal - column:3, row:5' => [$line, new Location(3, 5), false];
        yield 'horizontal - column:4, row:5' => [$line, new Location(4, 5), false];
        yield 'horizontal - column:5, row:5' => [$line, new Location(5, 5), false];
        yield 'horizontal - column:6, row:5' => [$line, new Location(6, 5), false];
        yield 'horizontal - column:7, row:5' => [$line, new Location(7, 5), false];
        yield 'horizontal - column:8, row:5' => [$line, new Location(8, 5), false];
        yield 'horizontal - column:9, row:5' => [$line, new Location(9, 5), false];
    }
}

<?php

declare(strict_types=1);

namespace Advent\Tests\Shared\Unit\Grid;

use Advent\Shared\Grid\Location;
use Advent\Shared\Grid\Adjacency;
use Advent\Tests\Shared\Mother\Grid\AdjacencyMother;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class CellTest extends TestCase
{
    #[Test]
    #[DataProvider('scenarios_for_position')]
    public function it_generates_relative_position_between_two_cells(Location $cellA, Location $cellB, Adjacency $position): void
    {
        $this->assertEquals($position, $cellA->adjacencyTo($cellB));
    }

    public static function scenarios_for_position(): iterable
    {
        $cellA = new Location(5, 5);

        // Row -2
        yield 'column:0, row:3' => [new Location(0, 3), $cellA, AdjacencyMother::distant()];
        yield 'column:1, row:3' => [new Location(1, 3), $cellA, AdjacencyMother::distant()];
        yield 'column:2, row:3' => [new Location(2, 3), $cellA, AdjacencyMother::distant()];
        yield 'column:3, row:3' => [new Location(3, 3), $cellA, AdjacencyMother::distant()];
        yield 'column:4, row:3' => [new Location(4, 3), $cellA, AdjacencyMother::leftColumnAndDistantRow()];
        yield 'column:5, row:3' => [new Location(5, 3), $cellA, AdjacencyMother::sameColumnAndDistantRow()];
        yield 'column:6, row:3' => [new Location(6, 3), $cellA, AdjacencyMother::rightColumnAndDistantRow()];
        yield 'column:7, row:3' => [new Location(7, 3), $cellA, AdjacencyMother::distant()];
        yield 'column:8, row:3' => [new Location(8, 3), $cellA, AdjacencyMother::distant()];
        yield 'column:9, row:3' => [new Location(9, 3), $cellA, AdjacencyMother::distant()];

        // Row -1
        yield 'column:0, row:4' => [new Location(0, 4), $cellA, AdjacencyMother::distantColumnAndAboveRow()];
        yield 'column:1, row:4' => [new Location(1, 4), $cellA, AdjacencyMother::distantColumnAndAboveRow()];
        yield 'column:2, row:4' => [new Location(2, 4), $cellA, AdjacencyMother::distantColumnAndAboveRow()];
        yield 'column:3, row:4' => [new Location(3, 4), $cellA, AdjacencyMother::distantColumnAndAboveRow()];
        yield 'column:4, row:4' => [new Location(4, 4), $cellA, AdjacencyMother::leftColumnAndAboveRow()];
        yield 'column:5, row:4' => [new Location(5, 4), $cellA, AdjacencyMother::sameColumnAndAboveRow()];
        yield 'column:6, row:4' => [new Location(6, 4), $cellA, AdjacencyMother::rightColumnAndAboveRow()];
        yield 'column:7, row:4' => [new Location(7, 4), $cellA, AdjacencyMother::distantColumnAndAboveRow()];
        yield 'column:8, row:4' => [new Location(8, 4), $cellA, AdjacencyMother::distantColumnAndAboveRow()];
        yield 'column:9, row:4' => [new Location(9, 4), $cellA, AdjacencyMother::distantColumnAndAboveRow()];

        // The Same Row
        yield 'column:0, row:5' => [new Location(0, 5), $cellA, AdjacencyMother::distantColumnAndSameRow()];
        yield 'column:1, row:5' => [new Location(1, 5), $cellA, AdjacencyMother::distantColumnAndSameRow()];
        yield 'column:2, row:5' => [new Location(2, 5), $cellA, AdjacencyMother::distantColumnAndSameRow()];
        yield 'column:3, row:5' => [new Location(3, 5), $cellA, AdjacencyMother::distantColumnAndSameRow()];
        yield 'column:4, row:5' => [new Location(4, 5), $cellA, AdjacencyMother::leftColumnAndSameRow()];
        yield 'column:5, row:5' => [new Location(5, 5), $cellA, AdjacencyMother::same()];
        yield 'column:6, row:5' => [new Location(6, 5), $cellA, AdjacencyMother::rightColumnAndSameRow()];
        yield 'column:7, row:5' => [new Location(7, 5), $cellA, AdjacencyMother::distantColumnAndSameRow()];
        yield 'column:8, row:5' => [new Location(8, 5), $cellA, AdjacencyMother::distantColumnAndSameRow()];
        yield 'column:9, row:5' => [new Location(9, 5), $cellA, AdjacencyMother::distantColumnAndSameRow()];

        // Row +1
        yield 'column:0, row:6' => [new Location(0, 6), $cellA, AdjacencyMother::distantColumnAndBelowRow()];
        yield 'column:1, row:6' => [new Location(1, 6), $cellA, AdjacencyMother::distantColumnAndBelowRow()];
        yield 'column:2, row:6' => [new Location(2, 6), $cellA, AdjacencyMother::distantColumnAndBelowRow()];
        yield 'column:3, row:6' => [new Location(3, 6), $cellA, AdjacencyMother::distantColumnAndBelowRow()];
        yield 'column:4, row:6' => [new Location(4, 6), $cellA, AdjacencyMother::leftColumnAndBelowRow()];
        yield 'column:5, row:6' => [new Location(5, 6), $cellA, AdjacencyMother::sameColumnAndBelowRow()];
        yield 'column:6, row:6' => [new Location(6, 6), $cellA, AdjacencyMother::rightColumnAndBelowRow()];
        yield 'column:7, row:6' => [new Location(7, 6), $cellA, AdjacencyMother::distantColumnAndBelowRow()];
        yield 'column:8, row:6' => [new Location(8, 6), $cellA, AdjacencyMother::distantColumnAndBelowRow()];
        yield 'column:9, row:6' => [new Location(9, 6), $cellA, AdjacencyMother::distantColumnAndBelowRow()];

        // Row +2
        yield 'column:0, row:7' => [new Location(0, 7), $cellA, AdjacencyMother::distant()];
        yield 'column:1, row:7' => [new Location(1, 7), $cellA, AdjacencyMother::distant()];
        yield 'column:2, row:7' => [new Location(2, 7), $cellA, AdjacencyMother::distant()];
        yield 'column:3, row:7' => [new Location(3, 7), $cellA, AdjacencyMother::distant()];
        yield 'column:4, row:7' => [new Location(4, 7), $cellA, AdjacencyMother::leftColumnAndDistantRow()];
        yield 'column:5, row:7' => [new Location(5, 7), $cellA, AdjacencyMother::sameColumnAndDistantRow()];
        yield 'column:6, row:7' => [new Location(6, 7), $cellA, AdjacencyMother::rightColumnAndDistantRow()];
        yield 'column:7, row:7' => [new Location(7, 7), $cellA, AdjacencyMother::distant()];
        yield 'column:8, row:7' => [new Location(8, 7), $cellA, AdjacencyMother::distant()];
        yield 'column:9, row:7' => [new Location(9, 7), $cellA, AdjacencyMother::distant()];
    }


    #[Test]
    #[DataProvider('scenarios')]
    public function it_checks_if_cells_are_adjacent(Location $cellA, Location $cellB, bool $isAdjacent): void
    {
        $this->assertSame($isAdjacent, $cellA->isAdjacentTo($cellB));
        $this->assertSame($isAdjacent, $cellB->isAdjacentTo($cellA));
    }

    public static function scenarios(): iterable
    {
        return [
            ...self::scenarios_for_cell_in_the_top_left_corner(),
            ...self::scenarios_for_cell_at_the_top(),
            ...self::scenarios_for_cell_below_the_top(),
            ...self::scenarios_for_cell_in_the_center(),
        ];
    }

    public static function scenarios_for_cell_in_the_top_left_corner(): iterable
    {
        $cellA = new Location(0, 0);

        // The Same Row
        yield 'top left corner - column:0, row:0' => [$cellA, new Location(0, 0), false];
        yield 'top left corner - column:1, row:0' => [$cellA, new Location(1, 0), true];
        yield 'top left corner - column:2, row:0' => [$cellA, new Location(2, 0), false];
        yield 'top left corner - column:3, row:0' => [$cellA, new Location(3, 0), false];
        yield 'top left corner - column:4, row:0' => [$cellA, new Location(4, 0), false];

        // Row +1
        yield 'top left corner - column:0, row:1' => [$cellA, new Location(0, 1), true];
        yield 'top left corner - column:1, row:1' => [$cellA, new Location(1, 1), true];
        yield 'top left corner - column:2, row:1' => [$cellA, new Location(2, 1), false];
        yield 'top left corner - column:3, row:1' => [$cellA, new Location(3, 1), false];
        yield 'top left corner - column:4, row:1' => [$cellA, new Location(4, 1), false];

        // Row +2
        yield 'top left corner - column:0, row:2' => [$cellA, new Location(0, 2), false];
        yield 'top left corner - column:1, row:2' => [$cellA, new Location(1, 2), false];
        yield 'top left corner - column:2, row:2' => [$cellA, new Location(2, 2), false];
        yield 'top left corner - column:3, row:2' => [$cellA, new Location(3, 2), false];
        yield 'top left corner - column:4, row:2' => [$cellA, new Location(4, 2), false];
    }

    public static function scenarios_for_cell_at_the_top(): iterable
    {
        $cellA = new Location(5, 0);

        // The Same Row
        yield 'top - column:0, row:0' => [$cellA, new Location(0, 0), false];
        yield 'top - column:1, row:0' => [$cellA, new Location(1, 0), false];
        yield 'top - column:2, row:0' => [$cellA, new Location(2, 0), false];
        yield 'top - column:3, row:0' => [$cellA, new Location(3, 0), false];
        yield 'top - column:4, row:0' => [$cellA, new Location(4, 0), true];
        yield 'top - column:5, row:0' => [$cellA, new Location(5, 0), false];
        yield 'top - column:6, row:0' => [$cellA, new Location(6, 0), true];
        yield 'top - column:7, row:0' => [$cellA, new Location(7, 0), false];
        yield 'top - column:8, row:0' => [$cellA, new Location(8, 0), false];
        yield 'top - column:9, row:0' => [$cellA, new Location(9, 0), false];

        // Row +1
        yield 'top - column:0, row:1' => [$cellA, new Location(0, 1), false];
        yield 'top - column:1, row:1' => [$cellA, new Location(1, 1), false];
        yield 'top - column:2, row:1' => [$cellA, new Location(2, 1), false];
        yield 'top - column:3, row:1' => [$cellA, new Location(3, 1), false];
        yield 'top - column:4, row:1' => [$cellA, new Location(4, 1), true];
        yield 'top - column:5, row:1' => [$cellA, new Location(5, 1), true];
        yield 'top - column:6, row:1' => [$cellA, new Location(6, 1), true];
        yield 'top - column:7, row:1' => [$cellA, new Location(7, 1), false];
        yield 'top - column:8, row:1' => [$cellA, new Location(8, 1), false];
        yield 'top - column:9, row:1' => [$cellA, new Location(9, 1), false];

        // Row +2
        yield 'top - column:0, row:2' => [$cellA, new Location(0, 2), false];
        yield 'top - column:1, row:2' => [$cellA, new Location(1, 2), false];
        yield 'top - column:2, row:2' => [$cellA, new Location(2, 2), false];
        yield 'top - column:3, row:2' => [$cellA, new Location(3, 2), false];
        yield 'top - column:4, row:2' => [$cellA, new Location(4, 2), false];
        yield 'top - column:5, row:2' => [$cellA, new Location(5, 2), false];
        yield 'top - column:6, row:2' => [$cellA, new Location(6, 2), false];
        yield 'top - column:7, row:2' => [$cellA, new Location(7, 2), false];
        yield 'top - column:8, row:2' => [$cellA, new Location(8, 2), false];
        yield 'top - column:9, row:2' => [$cellA, new Location(9, 2), false];
    }

    public static function scenarios_for_cell_below_the_top(): iterable
    {
        $cellA = new Location(0, 5);

        // Row -2
        yield 'below the top - column:0, row:3' => [$cellA, new Location(0, 3), false];
        yield 'below the top - column:1, row:3' => [$cellA, new Location(1, 3), false];
        yield 'below the top - column:2, row:3' => [$cellA, new Location(2, 3), false];
        yield 'below the top - column:3, row:3' => [$cellA, new Location(3, 3), false];
        yield 'below the top - column:4, row:3' => [$cellA, new Location(4, 3), false];
        yield 'below the top - column:5, row:3' => [$cellA, new Location(5, 3), false];
        yield 'below the top - column:6, row:3' => [$cellA, new Location(6, 3), false];
        yield 'below the top - column:7, row:3' => [$cellA, new Location(7, 3), false];
        yield 'below the top - column:8, row:3' => [$cellA, new Location(8, 3), false];
        yield 'below the top - column:9, row:3' => [$cellA, new Location(9, 3), false];

        // Row -1
        yield 'below the top - column:0, row:4' => [$cellA, new Location(0, 4), true];
        yield 'below the top - column:1, row:4' => [$cellA, new Location(1, 4), true];
        yield 'below the top - column:2, row:4' => [$cellA, new Location(2, 4), false];
        yield 'below the top - column:3, row:4' => [$cellA, new Location(3, 4), false];
        yield 'below the top - column:4, row:4' => [$cellA, new Location(4, 4), false];
        yield 'below the top - column:5, row:4' => [$cellA, new Location(5, 4), false];
        yield 'below the top - column:6, row:4' => [$cellA, new Location(6, 4), false];
        yield 'below the top - column:7, row:4' => [$cellA, new Location(7, 4), false];
        yield 'below the top - column:8, row:4' => [$cellA, new Location(8, 4), false];
        yield 'below the top - column:9, row:4' => [$cellA, new Location(9, 4), false];

        // The Same Row
        yield 'below the top - column:0, row:5' => [$cellA, new Location(0, 5), false];
        yield 'below the top - column:1, row:5' => [$cellA, new Location(1, 5), true];
        yield 'below the top - column:2, row:5' => [$cellA, new Location(2, 5), false];
        yield 'below the top - column:3, row:5' => [$cellA, new Location(3, 5), false];
        yield 'below the top - column:4, row:5' => [$cellA, new Location(4, 5), false];
        yield 'below the top - column:5, row:5' => [$cellA, new Location(5, 5), false];
        yield 'below the top - column:6, row:5' => [$cellA, new Location(6, 5), false];
        yield 'below the top - column:7, row:5' => [$cellA, new Location(7, 5), false];
        yield 'below the top - column:8, row:5' => [$cellA, new Location(8, 5), false];
        yield 'below the top - column:9, row:5' => [$cellA, new Location(9, 5), false];

        // Row +1
        yield 'below the top - column:0, row:6' => [$cellA, new Location(0, 6), true];
        yield 'below the top - column:1, row:6' => [$cellA, new Location(1, 6), true];
        yield 'below the top - column:2, row:6' => [$cellA, new Location(2, 6), false];
        yield 'below the top - column:3, row:6' => [$cellA, new Location(3, 6), false];
        yield 'below the top - column:4, row:6' => [$cellA, new Location(4, 6), false];
        yield 'below the top - column:5, row:6' => [$cellA, new Location(5, 6), false];
        yield 'below the top - column:6, row:6' => [$cellA, new Location(6, 6), false];
        yield 'below the top - column:7, row:6' => [$cellA, new Location(7, 6), false];
        yield 'below the top - column:8, row:6' => [$cellA, new Location(8, 6), false];
        yield 'below the top - column:9, row:6' => [$cellA, new Location(9, 6), false];

        // Row +2
        yield 'below the top - column:0, row:7' => [$cellA, new Location(0, 7), false];
        yield 'below the top - column:1, row:7' => [$cellA, new Location(1, 7), false];
        yield 'below the top - column:2, row:7' => [$cellA, new Location(2, 7), false];
        yield 'below the top - column:3, row:7' => [$cellA, new Location(3, 7), false];
        yield 'below the top - column:4, row:7' => [$cellA, new Location(4, 7), false];
        yield 'below the top - column:5, row:7' => [$cellA, new Location(5, 7), false];
        yield 'below the top - column:6, row:7' => [$cellA, new Location(6, 7), false];
        yield 'below the top - column:7, row:7' => [$cellA, new Location(7, 7), false];
        yield 'below the top - column:8, row:7' => [$cellA, new Location(8, 7), false];
        yield 'below the top - column:9, row:7' => [$cellA, new Location(9, 7), false];
    }

    public static function scenarios_for_cell_in_the_center(): iterable
    {
        $cellA = new Location(5, 5);

        // Row -2
        yield 'center - column:0, row:3' => [$cellA, new Location(0, 3), false];
        yield 'center - column:1, row:3' => [$cellA, new Location(1, 3), false];
        yield 'center - column:2, row:3' => [$cellA, new Location(2, 3), false];
        yield 'center - column:3, row:3' => [$cellA, new Location(3, 3), false];
        yield 'center - column:4, row:3' => [$cellA, new Location(4, 3), false];
        yield 'center - column:5, row:3' => [$cellA, new Location(5, 3), false];
        yield 'center - column:6, row:3' => [$cellA, new Location(6, 3), false];
        yield 'center - column:7, row:3' => [$cellA, new Location(7, 3), false];
        yield 'center - column:8, row:3' => [$cellA, new Location(8, 3), false];
        yield 'center - column:9, row:3' => [$cellA, new Location(9, 3), false];

        // Row -1
        yield 'center - column:0, row:4' => [$cellA, new Location(0, 4), false];
        yield 'center - column:1, row:4' => [$cellA, new Location(1, 4), false];
        yield 'center - column:2, row:4' => [$cellA, new Location(2, 4), false];
        yield 'center - column:3, row:4' => [$cellA, new Location(3, 4), false];
        yield 'center - column:4, row:4' => [$cellA, new Location(4, 4), true];
        yield 'center - column:5, row:4' => [$cellA, new Location(5, 4), true];
        yield 'center - column:6, row:4' => [$cellA, new Location(6, 4), true];
        yield 'center - column:7, row:4' => [$cellA, new Location(7, 4), false];
        yield 'center - column:8, row:4' => [$cellA, new Location(8, 4), false];
        yield 'center - column:9, row:4' => [$cellA, new Location(9, 4), false];

        // The Same Row
        yield 'center - column:0, row:5' => [$cellA, new Location(0, 5), false];
        yield 'center - column:1, row:5' => [$cellA, new Location(1, 5), false];
        yield 'center - column:2, row:5' => [$cellA, new Location(2, 5), false];
        yield 'center - column:3, row:5' => [$cellA, new Location(3, 5), false];
        yield 'center - column:4, row:5' => [$cellA, new Location(4, 5), true];
        yield 'center - column:5, row:5' => [$cellA, new Location(5, 5), false];
        yield 'center - column:6, row:5' => [$cellA, new Location(6, 5), true];
        yield 'center - column:7, row:5' => [$cellA, new Location(7, 5), false];
        yield 'center - column:8, row:5' => [$cellA, new Location(8, 5), false];
        yield 'center - column:9, row:5' => [$cellA, new Location(9, 5), false];

        // Row +1
        yield 'center - column:0, row:6' => [$cellA, new Location(0, 6), false];
        yield 'center - column:1, row:6' => [$cellA, new Location(1, 6), false];
        yield 'center - column:2, row:6' => [$cellA, new Location(2, 6), false];
        yield 'center - column:3, row:6' => [$cellA, new Location(3, 6), false];
        yield 'center - column:4, row:6' => [$cellA, new Location(4, 6), true];
        yield 'center - column:5, row:6' => [$cellA, new Location(5, 6), true];
        yield 'center - column:6, row:6' => [$cellA, new Location(6, 6), true];
        yield 'center - column:7, row:6' => [$cellA, new Location(7, 6), false];
        yield 'center - column:8, row:6' => [$cellA, new Location(8, 6), false];
        yield 'center - column:9, row:6' => [$cellA, new Location(9, 6), false];

        // Row +2
        yield 'center - column:0, row:7' => [$cellA, new Location(0, 7), false];
        yield 'center - column:1, row:7' => [$cellA, new Location(1, 7), false];
        yield 'center - column:2, row:7' => [$cellA, new Location(2, 7), false];
        yield 'center - column:3, row:7' => [$cellA, new Location(3, 7), false];
        yield 'center - column:4, row:7' => [$cellA, new Location(4, 7), false];
        yield 'center - column:5, row:7' => [$cellA, new Location(5, 7), false];
        yield 'center - column:6, row:7' => [$cellA, new Location(6, 7), false];
        yield 'center - column:7, row:7' => [$cellA, new Location(7, 7), false];
        yield 'center - column:8, row:7' => [$cellA, new Location(8, 7), false];
        yield 'center - column:9, row:7' => [$cellA, new Location(9, 7), false];
    }
}

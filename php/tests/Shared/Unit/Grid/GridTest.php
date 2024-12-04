<?php

declare(strict_types=1);

namespace Advent\Tests\Shared\Unit\Grid;

use Advent\Shared\Grid\Cell;
use Advent\Shared\Grid\Cell\StringCell;
use Advent\Shared\Grid\Cell\SubGridCell;
use Advent\Shared\Grid\Grid;
use Advent\Shared\Grid\Location;
use Advent\Shared\Grid\Pattern\PatternCell;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class GridTest extends TestCase
{
    private Grid $grid;
    private Cell $cellA;
    private Cell $cellB;
    private Cell $cellC;
    private Cell $cellD;
    private Cell $cellE;
    private Cell $cellF;
    private Cell $cellG;
    private Cell $cellH;
    private Cell $cellI;

    protected function setUp(): void
    {
        $this->cellA = new StringCell(x: 0, y: 0, value: 'A');
        $this->cellB = new StringCell(x: 1, y: 0, value: 'B');
        $this->cellC = new StringCell(x: 2, y: 0, value: 'C');

        $this->cellD = new StringCell(x: 0, y: 1, value: 'D');
        $this->cellE = new StringCell(x: 1, y: 1, value: 'E');
        $this->cellF = new StringCell(x: 2, y: 1, value: 'F');

        $this->cellG = new StringCell(x: 0, y: 2, value: 'G');
        $this->cellH = new StringCell(x: 1, y: 2, value: 'H');
        $this->cellI = new StringCell(x: 2, y: 2, value: 'I');

        $this->grid = Grid::fromArray([
            ['A', 'B', 'C'],
            ['D', 'E', 'F'],
            ['G', 'H', 'I'],
        ]);
    }

    #[Test]
    public function it_creates_grid_from_array(): void
    {
        $this->assertEquals(
            new Grid(
                new PatternCell(x: 0, y: 0, value: 'M'),
                new PatternCell(x: 1, y: 0, value: '.'),
                new PatternCell(x: 2, y: 0, value: 'S'),
                new PatternCell(x: 0, y: 1, value: '.'),
                new PatternCell(x: 1, y: 1, value: 'A'),
                new PatternCell(x: 2, y: 1, value: '.'),
                new PatternCell(x: 0, y: 2, value: 'M'),
                new PatternCell(x: 1, y: 2, value: '.'),
                new PatternCell(x: 2, y: 2, value: 'S'),
            ),
            Grid::fromPattern([
                ['M', '.', 'S'],
                ['.', 'A', '.'],
                ['M', '.', 'S'],
            ])
        );
    }

    #[Test]
    public function it_returns_cell_for_a_given_location(): void
    {
        $location = $this->cellD->location();

        $this->assertTrue($this->grid->hasCellAt($location));
        $this->assertEquals($this->cellD, $this->grid->findCellAt($location));
        $this->assertEquals($this->cellD, $this->grid->getCellAt($location));
    }

    #[Test]
    public function it_iterates_over_all_cells(): void
    {
        $this->assertEquals(
            [
                $this->cellA, $this->cellB, $this->cellC,
                $this->cellD, $this->cellE, $this->cellF,
                $this->cellG, $this->cellH, $this->cellI,
            ],
            iterator_to_array($this->grid->allCells())
        );
    }

    #[Test]
    public function it_iterates_over_all_rows(): void
    {
        $this->assertEquals(
            [
                [$this->cellA, $this->cellB, $this->cellC],
                [$this->cellD, $this->cellE, $this->cellF],
                [$this->cellG, $this->cellH, $this->cellI],
            ],
            iterator_to_array($this->grid->allRows())
        );
    }

    #[Test]
    public function it_iterates_over_all_columns(): void
    {
        $this->assertEquals(
            [
                [$this->cellA, $this->cellD, $this->cellG],
                [$this->cellB, $this->cellE, $this->cellH],
                [$this->cellC, $this->cellF, $this->cellI],
            ],
            iterator_to_array($this->grid->allColumns())
        );
    }

    #[Test]
    public function it_iterates_over_all_diagonals(): void
    {
        $this->assertEqualsCanonicalizing(
            [
                // left to right
                [$this->cellG],
                [$this->cellD, $this->cellH],
                [$this->cellA, $this->cellE, $this->cellI],
                [$this->cellB, $this->cellF],
                [$this->cellC],

                // right to left
                [$this->cellA],
                [$this->cellB, $this->cellD],
                [$this->cellC, $this->cellE, $this->cellG],
                [$this->cellF, $this->cellH],
                [$this->cellI],
            ],
            iterator_to_array($this->grid->allDiagonals())
        );
    }

    #[Test]
    public function it_iterates_over_all_sub_grids_of_a_given_size(): void
    {
        $this->assertEqualsCanonicalizing(
            [
                new Grid(
                    new SubGridCell(x: 0, y: 0, cell: $this->cellA),
                    new SubGridCell(x: 1, y: 0, cell: $this->cellB),
                    new SubGridCell(x: 0, y: 1, cell: $this->cellD),
                    new SubGridCell(x: 1, y: 1, cell: $this->cellE)
                ),
                new Grid(
                    new SubGridCell(x: 0, y: 0, cell: $this->cellB),
                    new SubGridCell(x: 1, y: 0, cell: $this->cellC),
                    new SubGridCell(x: 0, y: 1, cell: $this->cellE),
                    new SubGridCell(x: 1, y: 1, cell: $this->cellF)
                ),
                new Grid(
                    new SubGridCell(x: 0, y: 0, cell: $this->cellD),
                    new SubGridCell(x: 1, y: 0, cell: $this->cellE),
                    new SubGridCell(x: 0, y: 1, cell: $this->cellG),
                    new SubGridCell(x: 1, y: 1, cell: $this->cellH)
                ),
                new Grid(
                    new SubGridCell(x: 0, y: 0, cell: $this->cellE),
                    new SubGridCell(x: 1, y: 0, cell: $this->cellF),
                    new SubGridCell(x: 0, y: 1, cell: $this->cellH),
                    new SubGridCell(x: 1, y: 1, cell: $this->cellI)
                ),
            ],
            iterator_to_array($this->grid->subGrids(2, 2))
        );
    }
}

<?php

declare(strict_types=1);

namespace Advent\Tests\Shared\Unit\Grid;

use Advent\Shared\Grid\Cell;
use Advent\Shared\Grid\Cell\StringCell;
use Advent\Shared\Grid\Grid;
use Advent\Shared\Grid\Location;
use Advent\Shared\Grid\Pattern\PatternCell;
use Advent\Shared\Grid\Pattern\SubGridCell;
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
        $this->cellA = StringCell::create(0, 0, 'A');
        $this->cellB = StringCell::create(1, 0, 'B');
        $this->cellC = StringCell::create(2, 0, 'C');

        $this->cellD = StringCell::create(0, 1, 'D');
        $this->cellE = StringCell::create(1, 1, 'E');
        $this->cellF = StringCell::create(2, 1, 'F');

        $this->cellG = StringCell::create(0, 2, 'G');
        $this->cellH = StringCell::create(1, 2, 'H');
        $this->cellI = StringCell::create(2, 2, 'I');

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
                new PatternCell(new Location(0, 0), 'M'),
                new PatternCell(new Location(1, 0), '.'),
                new PatternCell(new Location(2, 0), 'S'),
                new PatternCell(new Location(0, 1), '.'),
                new PatternCell(new Location(1, 1), 'A'),
                new PatternCell(new Location(2, 1), '.'),
                new PatternCell(new Location(0, 2), 'M'),
                new PatternCell(new Location(1, 2), '.'),
                new PatternCell(new Location(2, 2), 'S'),
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
                    new SubGridCell($this->cellA, new Location(0, 0)),
                    new SubGridCell($this->cellB, new Location(1, 0)),
                    new SubGridCell($this->cellD, new Location(0, 1)),
                    new SubGridCell($this->cellE, new Location(1, 1))
                ),
                new Grid(
                    new SubGridCell($this->cellB, new Location(0, 0)),
                    new SubGridCell($this->cellC, new Location(1, 0)),
                    new SubGridCell($this->cellE, new Location(0, 1)),
                    new SubGridCell($this->cellF, new Location(1, 1))
                ),
                new Grid(
                    new SubGridCell($this->cellD, new Location(0, 0)),
                    new SubGridCell($this->cellE, new Location(1, 0)),
                    new SubGridCell($this->cellG, new Location(0, 1)),
                    new SubGridCell($this->cellH, new Location(1, 1))
                ),
                new Grid(
                    new SubGridCell($this->cellE, new Location(0, 0)),
                    new SubGridCell($this->cellF, new Location(1, 0)),
                    new SubGridCell($this->cellH, new Location(0, 1)),
                    new SubGridCell($this->cellI, new Location(1, 1))
                ),
            ],
            iterator_to_array($this->grid->subGrids(2, 2))
        );
    }
}

<?php

declare(strict_types=1);

namespace Advent\Tests\Shared\Unit\Grid;

use Advent\Shared\Grid\Grid;
use Advent\Shared\Grid\Location;
use Advent\Tests\Shared\Doubles\CellStub;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class GridTest extends TestCase
{
    private Grid $grid;

    protected function setUp(): void
    {
        $this->grid = new Grid(
            CellStub::create(0, 0),
            CellStub::create(1, 0),
            CellStub::create(2, 0),
            CellStub::create(0, 1),
            CellStub::create(1, 1),
            CellStub::create(2, 1),
            CellStub::create(0, 2),
            CellStub::create(1, 2),
            CellStub::create(2, 2)
        );
    }

    #[Test]
    public function it_returns_cell_for_a_given_location(): void
    {
        $location = new Location(1, 1);

        $this->assertTrue($this->grid->hasCellAt($location));
        $this->assertEquals($location, $this->grid->findCellAt($location)->location());
        $this->assertEquals($location, $this->grid->getCellAt($location)->location());
    }

    #[Test]
    public function it_iterates_over_all_cells(): void
    {
        $this->assertEquals(
            [
                CellStub::create(0, 0),
                CellStub::create(1, 0),
                CellStub::create(2, 0),
                CellStub::create(0, 1),
                CellStub::create(1, 1),
                CellStub::create(2, 1),
                CellStub::create(0, 2),
                CellStub::create(1, 2),
                CellStub::create(2, 2),
            ],
            iterator_to_array($this->grid->allCells())
        );
    }

    #[Test]
    public function it_iterates_over_all_rows(): void
    {
        $this->assertEquals(
            [
                [CellStub::create(0, 0), CellStub::create(1, 0), CellStub::create(2, 0)],
                [CellStub::create(0, 1), CellStub::create(1, 1), CellStub::create(2, 1)],
                [CellStub::create(0, 2), CellStub::create(1, 2), CellStub::create(2, 2)],
            ],
            iterator_to_array($this->grid->allRows())
        );
    }

    #[Test]
    public function it_iterates_over_all_columns(): void
    {
        $this->assertEquals(
            [
                [CellStub::create(0, 0), CellStub::create(0, 1), CellStub::create(0, 2)],
                [CellStub::create(1, 0), CellStub::create(1, 1), CellStub::create(1, 2)],
                [CellStub::create(2, 0), CellStub::create(2, 1), CellStub::create(2, 2)],
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
                [CellStub::create(0, 2)],
                [CellStub::create(0, 1), CellStub::create(1, 2)],
                [CellStub::create(0, 0), CellStub::create(1, 1), CellStub::create(2, 2)],
                [CellStub::create(1, 0), CellStub::create(2, 1)],
                [CellStub::create(2, 0)],
                // right to left
                [CellStub::create(0, 0)],
                [CellStub::create(1, 0), CellStub::create(0, 1)],
                [CellStub::create(2, 0), CellStub::create(1, 1), CellStub::create(0, 2)],
                [CellStub::create(2, 1), CellStub::create(1, 2)],
                [CellStub::create(2, 2)],
            ],
            iterator_to_array($this->grid->allDiagonals())
        );
    }
}

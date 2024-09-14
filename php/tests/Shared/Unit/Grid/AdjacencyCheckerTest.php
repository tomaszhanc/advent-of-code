<?php

namespace Advent\Tests\Shared\Unit\Grid;

use Advent\Shared\Grid\AdjacencyChecker;
use Advent\Shared\Grid\Cell;
use Advent\Shared\Grid\Line;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class AdjacencyCheckerTest extends TestCase
{
    #[Test]
    public function it_prevents_creating_checker_for_horizontal_range_when_vertical_range_is_given(): void
    {
        $this->expectExceptionMessage('Given range must be horizontal');

        AdjacencyChecker::forHorizontalLine(
            new Line(
                new Cell(2, 3),
                new Cell(2, 7)
            ),
            new Cell(9, 9)
        );
    }

    #[Test]
    public function it_prevents_creating_checker_for_vertical_range_when_horizontal_range_is_given(): void
    {
        $this->expectExceptionMessage('Given range must be vertical');

        AdjacencyChecker::forVerticalLine(
            new Line(
                new Cell(2, 3),
                new Cell(7, 3)
            ),
            new Cell(9, 9)
        );
    }
}

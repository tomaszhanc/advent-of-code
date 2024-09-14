<?php

namespace Advent\Tests\Shared\Unit\Grid;

use Advent\Shared\Grid\Cell;
use Advent\Shared\Grid\Line\AdjacencyChecker;
use Advent\Shared\Grid\Line\HorizontalLine;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class AdjacencyCheckerTest extends TestCase
{
    #[Test]
    public function it_prevents_creating_checker_for_horizontal_line_when_vertical_line_is_given(): void
    {
        $this->expectExceptionMessage('Given line must be horizontal');

        AdjacencyChecker::forHorizontalLine(
            new HorizontalLine(
                new Cell(2, 3),
                new Cell(2, 7)
            ),
            new Cell(9, 9)
        );
    }

    #[Test]
    public function it_prevents_creating_checker_for_vertical_line_when_horizontal_line_is_given(): void
    {
        $this->expectExceptionMessage('Given line must be vertical');

        AdjacencyChecker::forVerticalLine(
            new HorizontalLine(
                new Cell(2, 3),
                new Cell(7, 3)
            ),
            new Cell(9, 9)
        );
    }
}

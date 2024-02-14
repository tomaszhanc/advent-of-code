<?php

namespace AoC\Common\Tests\Range;

use AoC\Common\Cell;
use AoC\Common\Range;
use AoC\Common\Range\CallAdjacencyChecker;
use PHPUnit\Framework\TestCase;

final class CallAdjacencyCheckerTest extends TestCase
{
    public function test_prevents_creating_checker_for_horizontal_range_when_vertical_range_is_given(): void
    {
        $this->expectExceptionMessage('Given range must be horizontal');

        CallAdjacencyChecker::forHorizontalRange(
            new Range(
                new Cell(2, 3),
                new Cell(2, 7)
            ),
            new Cell(9, 9)
        );
    }

    public function test_prevents_creating_checker_for_vertical_range_when_horizontal_range_is_given(): void
    {
        $this->expectExceptionMessage('Given range must be vertical');

        CallAdjacencyChecker::forVerticalRange(
            new Range(
                new Cell(2, 3),
                new Cell(7, 3)
            ),
            new Cell(9, 9)
        );
    }
}

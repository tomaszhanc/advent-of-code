<?php

declare(strict_types=1);

namespace Advent\Tests\Year2024\Tests\Day2;

use Advent\Tests\Shared\Doubles\InMemoryInput;
use Advent\Tests\Year2024\PuzzleInputs;
use Advent\Year2024\Day2\PuzzleSolver;
use Advent\Year2024\Day2\Parser\ReportParser;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PuzzleSolverTest extends TestCase
{
    private PuzzleSolver $solver;

    protected function setUp(): void
    {
        $this->solver = new PuzzleSolver(new ReportParser());
    }

    #[Test]
    public function it_returns_number_od_safe_reports(): void
    {
        $input = new InMemoryInput(
            '7 6 4 2 1', // safe
            '1 2 7 8 9', // unsafe
            '9 7 6 2 1', // unsafe
            '1 3 2 4 5', // unsafe
            '8 6 4 4 1', // unsafe
            '1 3 6 7 9', // safe
        );

        $this->assertEquals(2, $this->solver->numberOfSafeReports($input));
    }

    #[Test]
    public function it_solves_day_2_part_1(): void
    {
        $this->assertEquals(639, $this->solver->numberOfSafeReports(PuzzleInputs::day2_unusual_data()));
    }

    #[Test]
    public function it_solves_day_2_part_2(): void
    {
        $this->assertEquals(674, $this->solver->numberOfSafeReportsWithAtMostSingleBadLevel(PuzzleInputs::day2_unusual_data()));
    }
}

<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day9;

use Advent\Tests\Shared\Doubles\InMemoryInput;
use Advent\Tests\Year2023\PuzzleInputs;
use Advent\Year2023\Day9\Model\SequenceExtrapolation;
use Advent\Year2023\Day9\PuzzleSolver;
use Advent\Year2023\Day9\Parser\ReportParser;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PuzzleSolverTest extends TestCase
{
    private PuzzleSolver $solver;

    protected function setUp(): void
    {
        $this->solver = new PuzzleSolver(new ReportParser(), new SequenceExtrapolation());
    }

    #[Test]
    public function it_returns_sum_of_extrapolated_values(): void
    {
        $input = new InMemoryInput(
            '0 3 6 9 12 15',
            '1 3 6 10 15 21',
            '10 13 16 21 30 45'
        );

        $this->assertEquals(114, $this->solver->sumOfNextExtrapolatedValues($input));
    }

    #[Test]
    public function it_solves_day_9_part_1(): void
    {
        $this->assertEquals(2005352194, $this->solver->sumOfNextExtrapolatedValues(PuzzleInputs::day9_oasis_report()));
    }

    #[Test]
    public function it_solves_day_9_part_2(): void
    {
        $this->assertEquals(1077, $this->solver->sumOfPreviousExtrapolatedValues(PuzzleInputs::day9_oasis_report()));
    }
}

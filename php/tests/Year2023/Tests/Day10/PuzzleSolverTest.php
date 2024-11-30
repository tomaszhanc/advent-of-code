<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day10;

use Advent\Tests\Shared\Doubles\InMemoryInput;
use Advent\Tests\Year2023\PuzzleInputs;
use Advent\Year2023\Day10\PuzzleSolver;
use Advent\Year2023\Day10\Parser\PipeParser;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PuzzleSolverTest extends TestCase
{
    private PuzzleSolver $solver;

    protected function setUp(): void
    {
        $this->solver = new PuzzleSolver(new PipeParser());
    }

    #[Test]
    public function it_returns_number_of_steps_to_furthest_position_from_starting_point(): void
    {
        $input = new InMemoryInput(
            '..F7.',
            '.FJ|.',
            'SJ.L7',
            '|F--J',
            'LJ...',
        );

        $this->assertEquals(8, $this->solver->numberOfStepsToFurthestPositionFromStartingPoint($input));
    }

    #[Test]
    public function it_solves_day_10_part_1(): void
    {
        $this->assertEquals(7063, $this->solver->numberOfStepsToFurthestPositionFromStartingPoint(PuzzleInputs::day10_pipe_diagram()));
    }

    #[Test]
    public function it_solves_day_10_part_2(): void
    {
        $this->assertEquals(0, $this->solver->bar(PuzzleInputs::day10_()));
    }
}

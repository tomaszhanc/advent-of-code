<?php

declare(strict_types=1);

namespace Advent\Tests\Year2024\Tests\Day6;

use Advent\Tests\Shared\Doubles\InMemoryInput;
use Advent\Tests\Year2024\PuzzleInputs;
use Advent\Year2024\Day6\Model\GamePlay;
use Advent\Year2024\Day6\PuzzleSolver;
use Advent\Year2024\Day6\Parser\MapParser;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PuzzleSolverTest extends TestCase
{
    private PuzzleSolver $solver;

    protected function setUp(): void
    {
        $this->solver = new PuzzleSolver(
            new MapParser(),
            new GamePlay()
        );
    }

    #[Test]
    public function it_returns_number_of_positions_visited_by_guard(): void
    {
        $input = new InMemoryInput(
            '....#.....',
            '.........#',
            '..........',
            '..#.......',
            '.......#..',
            '..........',
            '.#..^.....',
            '........#.',
            '#.........',
            '......#...',
        );

        $this->assertEquals(41, $this->solver->numberOfPositionsVisitedByGuard($input));
    }

    #[Test]
    public function it_solves_day_X_part_1(): void
    {
        $this->assertEquals(4982, $this->solver->numberOfPositionsVisitedByGuard(PuzzleInputs::day6_guard()));
    }

    #[Test]
    public function it_solves_day_X_part_2(): void
    {
        $this->assertEquals(0, $this->solver->bar(PuzzleInputs::Day6_()));
    }
}

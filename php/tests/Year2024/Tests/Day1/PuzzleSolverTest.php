<?php

declare(strict_types=1);

namespace Advent\Tests\Year2024\Tests\Day1;

use Advent\Tests\Shared\Doubles\InMemoryInput;
use Advent\Tests\Year2024\PuzzleInputs;
use Advent\Year2024\Day1\PuzzleSolver;
use Advent\Year2024\Day1\Parser\Parser;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PuzzleSolverTest extends TestCase
{
    private PuzzleSolver $solver;

    protected function setUp(): void
    {
        $this->solver = new PuzzleSolver(new Parser());
    }

    #[Test]
    public function it_returns_distance_between_two_lists(): void
    {
        $input = new InMemoryInput(
            '3   4',
            '4   3',
            '2   5',
            '1   3',
            '3   9',
            '3   3',
        );

        $this->assertEquals(11, $this->solver->totalDistanceBetweenTwoLists($input));
    }

    #[Test]
    public function it_returns_similarity_score_of_two_lists(): void
    {
        $input = new InMemoryInput(
            '3   4',
            '4   3',
            '2   5',
            '1   3',
            '3   9',
            '3   3',
        );

        $this->assertEquals(31, $this->solver->similarityScore($input));
    }

    #[Test]
    public function it_solves_day_1_part_1(): void
    {
        $this->assertEquals(2176849, $this->solver->totalDistanceBetweenTwoLists(PuzzleInputs::day1_list()));
    }

    #[Test]
    public function it_solves_day_1_part_2(): void
    {
        $this->assertEquals(23384288, $this->solver->similarityScore(PuzzleInputs::day1_list()));
    }
}

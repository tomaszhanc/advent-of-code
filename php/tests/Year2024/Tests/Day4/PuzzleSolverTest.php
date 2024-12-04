<?php

declare(strict_types=1);

namespace Advent\Tests\Year2024\Tests\Day4;

use Advent\Tests\Shared\Doubles\InMemoryInput;
use Advent\Tests\Year2024\PuzzleInputs;
use Advent\Year2024\Day4\PuzzleSolver;
use Advent\Year2024\Day4\Parser\CrosswordParser;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PuzzleSolverTest extends TestCase
{
    private PuzzleSolver $solver;

    protected function setUp(): void
    {
        $this->solver = new PuzzleSolver(new CrosswordParser());
    }

    #[Test]
    public function it_returns_number_of_occurrences(): void
    {
        $input = new InMemoryInput(
            'MMMSXXMASM',
            'MSAMXMSMSA',
            'AMXSXMAAMM',
            'MSAMASMSMX',
            'XMASAMXAMM',
            'XXAMMXXAMA',
            'SMSMSASXSS',
            'SAXAMASAAA',
            'MAMMMXMMMM',
            'MXMXAXMASX'
        );

        $this->assertEquals(18, $this->solver->numberOfOccurrences('XMAS', $input));
    }

    #[Test]
    public function it_solves_day_4_part_1(): void
    {
        $this->assertEquals(2639, $this->solver->numberOfOccurrences('XMAS', PuzzleInputs::day4_crossword()));
    }

    //    #[Test]
    public function it_solves_day_4_part_2(): void
    {
        $this->assertEquals(0, $this->solver->numberOfOccurrences('XMAS', PuzzleInputs::day4_crossword()));
    }
}

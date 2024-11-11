<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day6;

use Advent\Shared\Lexer\Lexer;
use Advent\Tests\Year2023\PuzzleInputs;
use Advent\Year2023\Day6\Parser\RaceLogType;
use Advent\Year2023\Day6\PuzzleSolver;
use Advent\Year2023\Day6\Parser\RaceLogParser;
use Advent\Tests\Shared\Doubles\InMemoryInput;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PuzzleSolverTest extends TestCase
{
    private PuzzleSolver $solver;

    protected function setUp(): void
    {
        $this->solver = new PuzzleSolver(new RaceLogParser(new Lexer(RaceLogType::class)));
    }

    #[Test]
    public function it_returns_product_of_all_number_of_ways_of_winning(): void
    {
        $input = new InMemoryInput(
            'Time:      7  15   30',
            'Distance:  9  40  200',
        );

        $this->assertEquals(288, $this->solver->productOfAllNumberOfWaysOfWinning($input));
    }

    #[Test]
    public function it_solves_day_6_part_1_multiply_number_of_ways_to_win_from_all_races(): void
    {
        $this->assertEquals(128700, $this->solver->productOfAllNumberOfWaysOfWinning(PuzzleInputs::day6_sheetOfPaper()));
    }

    #[Test]
    public function it_solves_day_6_part_2_number_of_ways_to_win_from_single_races(): void
    {
        $this->assertEquals(39594072, $this->solver->productOfAllNumberOfWaysOfWinning(PuzzleInputs::day6_sheetOfPaperWithFixedKerning()));
    }
}

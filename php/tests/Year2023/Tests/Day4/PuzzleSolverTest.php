<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day4;

use Advent\Shared\Lexer\Lexer;
use Advent\Tests\Shared\Doubles\InMemoryInput;
use Advent\Tests\Year2023\PuzzleInputs;
use Advent\Year2023\Day4\Parser\ScratchcardParser;
use Advent\Year2023\Day4\Parser\ScratchcardType;
use Advent\Year2023\Day4\PuzzleSolver;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PuzzleSolverTest extends TestCase
{
    private PuzzleSolver $solver;

    protected function setUp(): void
    {
        $this->solver = new PuzzleSolver(new ScratchcardParser(new Lexer(ScratchcardType::class)));
    }

    #[Test]
    public function it_sums_all_points(): void
    {
        $input = new InMemoryInput(
            'Card 1: 41 48 83 86 17 | 83 86  6 31 17  9 48 53', // winners: 48, 83, 86, 17 => 2^3 = 8
            'Card 2: 13 32 20 16 61 | 61 30 68 82 17 32 24 19', // winners: 32, 61 => 2^1 = 2
            'Card 3:  1 21 53 59 44 | 69 82 63 72 16 21 14  1', // winners: 21, 1 => 2^1 = 2
            'Card 4: 41 92 73 84 69 | 59 84 76 51 58  5 54 83', // winners: 84 => 2^0 = 1
            'Card 5: 87 83 26 28 32 | 88 30 70 12 93 22 82 36', // winners: none => 0
            'Card 6: 31 18 13 56 72 | 74 77 10 23 35 67 36 11', // winners: none => 0
        );

        $this->assertEquals(13, $this->solver->sumAllPoints($input));
    }

    #[Test]
    public function it_counts_all_won_scratchcards(): void
    {
        $input = new InMemoryInput(
            'Card 1: 41 48 83 86 17 | 83 86  6 31 17  9 48 53', // winners: 48, 83, 86, 17 => wins copy of cards: 2, 3, 4, 5
            'Card 2: 13 32 20 16 61 | 61 30 68 82 17 32 24 19', // winners: 32, 61         => wins copy of cards: 3, 4
            'Card 3:  1 21 53 59 44 | 69 82 63 72 16 21 14  1', // winners: 21, 1          => wins copy of cards: 4, 5
            'Card 4: 41 92 73 84 69 | 59 84 76 51 58  5 54 83', // winners: 84             => wins copy of cards: 5
            'Card 5: 87 83 26 28 32 | 88 30 70 12 93 22 82 36', // winners: none
            'Card 6: 31 18 13 56 72 | 74 77 10 23 35 67 36 11', // winners: none
        );
        // WINNINGS: 1x Card 1, 2x Card 2, 4x Card 3, 8x Card 4, 14x Card 5, 1x Card 6 = 30 cards in total

        $this->assertEquals(30, $this->solver->countAllWonScratchcards($input));
    }

    #[Test]
    public function it_solves_day_4_part_1_sum_all_scratchpads_points(): void
    {
        $this->assertEquals(23678, $this->solver->sumAllPoints(PuzzleInputs::day4_scratchpadsRecord()));
    }

    #[Test]
    public function it_solves_day_4_part_2_count_all_won_scratchpads(): void
    {
        $this->assertEquals(15455663, $this->solver->countAllWonScratchcards(PuzzleInputs::day4_scratchpadsRecord()));
    }
}

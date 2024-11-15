<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day7;

use Advent\Tests\Year2023\PuzzleInputs;
use Advent\Year2023\Day7\PuzzleSolver;
use Advent\Year2023\Day7\Parser\CamelCardsParser;
use Advent\Tests\Shared\Doubles\InMemoryInput;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PuzzleSolverTest extends TestCase
{
    private PuzzleSolver $solver;

    protected function setUp(): void
    {
        $this->solver = new PuzzleSolver(new CamelCardsParser(), );
    }

    #[Test]
    public function it_returns_total_winnings(): void
    {
        $input = new InMemoryInput(
            '32T3K 765',
            'T55J5 684',
            'KK677 28',
            'KTJJT 220',
            'QQQJA 483'
        );

        $this->assertEquals(6440, $this->solver->totalWinningsFor($input));
    }

    #[Test]
    public function it_solves_day_7_part_1_calculate_total_winnings(): void
    {
        $this->assertEquals(254024898, $this->solver->totalWinningsFor(PuzzleInputs::day7_listOfHands()));
    }

    #[Test]
    public function it_solves_day_7_part_2_calculate_total_winnings_with_jokers_in_play(): void
    {
        $this->assertEquals(254115617, $this->solver->totalWinningsWithJokersFor(PuzzleInputs::day7_listOfHands()));
    }
}

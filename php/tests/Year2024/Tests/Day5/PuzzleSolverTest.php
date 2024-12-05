<?php

declare(strict_types=1);

namespace Advent\Tests\Year2024\Tests\Day5;

use Advent\Tests\Shared\Doubles\InMemoryInput;
use Advent\Tests\Year2024\PuzzleInputs;
use Advent\Year2024\Day5\PuzzleSolver;
use Advent\Year2024\Day5\Parser\PageOrderingRulesParser;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PuzzleSolverTest extends TestCase
{
    private PuzzleSolver $solver;

    protected function setUp(): void
    {
        $this->solver = new PuzzleSolver(new PageOrderingRulesParser());
    }

    #[Test]
    public function it_returns_sum_of_middle_numbers_of_updates_in_right_order(): void
    {
        $input = new InMemoryInput(
            '47|53',
            '97|13',
            '97|61',
            '97|47',
            '75|29',
            '61|13',
            '75|53',
            '29|13',
            '97|29',
            '53|29',
            '61|53',
            '97|53',
            '61|29',
            '47|13',
            '75|47',
            '97|75',
            '47|61',
            '75|61',
            '47|29',
            '75|13',
            '53|13',
            '',
            '75,47,61,53,29',
            '97,61,53,29,13',
            '75,29,13',
            '75,97,47,61,53',
            '61,13,29',
            '97,13,75,29,47'
        );

        $this->assertEquals(143, $this->solver->sumOfMiddleNumbersOfUpdatesInRightOrder($input));
    }

    #[Test]
    public function it_returns_sum_of_middle_numbers_of_corrected_updates(): void
    {
        $input = new InMemoryInput(
            '47|53',
            '97|13',
            '97|61',
            '97|47',
            '75|29',
            '61|13',
            '75|53',
            '29|13',
            '97|29',
            '53|29',
            '61|53',
            '97|53',
            '61|29',
            '47|13',
            '75|47',
            '97|75',
            '47|61',
            '75|61',
            '47|29',
            '75|13',
            '53|13',
            '',
            '75,47,61,53,29',
            '97,61,53,29,13',
            '75,29,13',
            '75,97,47,61,53',
            '61,13,29',
            '97,13,75,29,47'
        );

        $this->assertEquals(123, $this->solver->sumOfMiddleNumbersOfCorrectedUpdates($input));
    }

    #[Test]
    public function it_solves_day_5_part_1(): void
    {
        $this->assertEquals(5955, $this->solver->sumOfMiddleNumbersOfUpdatesInRightOrder(PuzzleInputs::day5_page_updates()));
    }

    #[Test]
    public function it_solves_day_5_part_2(): void
    {
        $this->assertEquals(4030, $this->solver->sumOfMiddleNumbersOfCorrectedUpdates(PuzzleInputs::day5_page_updates()));
    }
}

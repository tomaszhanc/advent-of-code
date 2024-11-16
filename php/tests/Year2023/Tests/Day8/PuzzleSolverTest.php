<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day8;

use Advent\Tests\Shared\Doubles\InMemoryInput;
use Advent\Tests\Year2023\PuzzleInputs;
use Advent\Year2023\Day8\Parser\Parser;
use Advent\Year2023\Day8\PuzzleSolver;
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
    public function it_returns_number_of_steps_to_reach_ZZZ(): void
    {
        $input = new InMemoryInput(
            'RL',
            '',
            'AAA = (BBB, CCC)',
            'BBB = (DDD, EEE)',
            'CCC = (ZZZ, GGG)',
            'DDD = (DDD, DDD)',
            'EEE = (EEE, EEE)',
            'GGG = (GGG, GGG)',
            'ZZZ = (ZZZ, ZZZ)',
        );

        $this->assertEquals(2, $this->solver->numberOfStepsFromAAAToZZZ($input));
    }

    #[Test]
    public function it_solves_day_8_part_1_number_of_steps_to_reach_ZZZ(): void
    {
        $this->assertEquals(20093, $this->solver->numberOfStepsFromAAAToZZZ(PuzzleInputs::day8_navigation_document()));
    }

    #[Test]
    public function it_solves_day_8_part_2_number_of_steps_to_reach_all_final_destinations(): void
    {
        $this->assertEquals(22103062509257, $this->solver->numberOfStepsFromAllStartingPositions(PuzzleInputs::day8_navigation_document()));
    }
}

<?php

declare(strict_types=1);

namespace Advent\Tests\Year2024\Tests\Day3;

use Advent\Tests\Shared\Doubles\InMemoryInput;
use Advent\Tests\Year2024\PuzzleInputs;
use Advent\Year2024\Day3\PuzzleSolver;
use Advent\Year2024\Day3\Parser\ProgramMemoryParser;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PuzzleSolverTest extends TestCase
{
    private PuzzleSolver $solver;

    protected function setUp(): void
    {
        $this->solver = new PuzzleSolver(new ProgramMemoryParser());
    }

    #[Test]
    public function it_returns_sum_of_all_valid_mul_operations(): void
    {
        $input = new InMemoryInput('xmul(2,4)%&mul[3,7]!@^do_not_mul(5,5)+mul(32,64]then(mul(11,8)mul(8,5))');

        $this->assertEquals(161, $this->solver->sumAllMulOperations($input));
    }

    #[Test]
    public function it_solves_day_3_part_1(): void
    {
        $this->assertEquals(179571322, $this->solver->sumAllMulOperations(PuzzleInputs::day3_program_memory()));
    }

    #[Test]
    public function it_solves_day_3_part_2(): void
    {
        $this->assertEquals(103811193, $this->solver->sumAllEnabledMulOperations(PuzzleInputs::day3_program_memory()));
    }
}

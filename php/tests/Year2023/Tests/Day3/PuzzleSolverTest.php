<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day3;

use Advent\Shared\Lexer\Lexer;
use Advent\Tests\Shared\Doubles\InMemoryInput;
use Advent\Tests\Year2023\PuzzleInputs;
use Advent\Year2023\Day3\Model\GearsFactory;
use Advent\Year2023\Day3\Parser\EngineSchematicType;
use Advent\Year2023\Day3\PuzzleSolver;
use Advent\Year2023\Day3\Model\PartNumbersFactory;
use Advent\Year2023\Day3\Parser\EngineSchematicParser;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PuzzleSolverTest extends TestCase
{
    private PuzzleSolver $solver;

    protected function setUp(): void
    {
        $this->solver = new PuzzleSolver(
            new EngineSchematicParser(new Lexer(EngineSchematicType::class)),
            new PartNumbersFactory(),
            new GearsFactory()
        );
    }


    #[Test]
    public function it_sums_numbers_of_all_elements_that_are_part_numbers(): void
    {
        $input = new InMemoryInput(
            '467..114..',
            '...*......',
            '..35..633.',
            '......#...',
            '617*......',
            '.....+.58.',
            '..592.....',
            '......755.',
            '...$.*....',
            '.664.598..',
        );

        $this->assertEquals(4361, $this->solver->sumAllPartNumbers($input));
    }

    #[Test]
    public function it_sums_all_gear_ratios(): void
    {
        $input = new InMemoryInput(
            '467..114..',
            '...*......',
            '..35..633.',
            '......#...',
            '617*......',
            '.....+.58.',
            '..592.....',
            '......755.',
            '...$.*....',
            '.664.598..',
        );

        $this->assertEquals(467835, $this->solver->sumAllGearRatios($input));
    }

    #[Test]
    public function it_solves_day_3_part_1_sum_all_part_numbers(): void
    {
        $this->assertEquals(544433, $this->solver->sumAllPartNumbers(PuzzleInputs::day3_engineSchematic()));
    }

    #[Test]
    public function it_solves_day_3_part_2_sum_all_gear_ratios(): void
    {
        $this->assertEquals(76314915, $this->solver->sumAllGearRatios(PuzzleInputs::day3_engineSchematic()));
    }
}

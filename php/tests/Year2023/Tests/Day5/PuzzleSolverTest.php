<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day5;

use Advent\Shared\Input\FileInput;
use Advent\Shared\Lexer\Lexer;
use Advent\Tests\Year2023\PuzzleInputs;
use Advent\Year2023\Day5\PuzzleSolver;
use Advent\Year2023\Day5\Parser\AlmanacParser;
use Advent\Year2023\Day5\Parser\AlmanacType;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PuzzleSolverTest extends TestCase
{
    private PuzzleSolver $solver;

    protected function setUp(): void
    {
        $this->solver = new PuzzleSolver(new AlmanacParser(new Lexer(AlmanacType::class)));
    }

    #[Test]
    public function it_gets_lowest_location_number_from_almanac(): void
    {
        $input = FileInput::fromLocal(__DIR__ . '/../../Resources/test_day5.txt');

        $this->assertEquals(35, $this->solver->lowestLocationNumber($input));
    }

    #[Test]
    public function it_gets_lowest_location_number_from_almanac_with_seed_ranges(): void
    {
        $input =  FileInput::fromLocal(__DIR__ . '/../../Resources/test_day5.txt');

        $this->assertEquals(46, $this->solver->lowestLocationNumberWithSeedRanges($input));
    }

    #[Test]
    public function it_solves_day_5_part_1_lowest_location_number(): void
    {
        $this->assertEquals(107430936, $this->solver->lowestLocationNumber(PuzzleInputs::day5_almanac()));
    }

    #[Test]
    public function it_solves_day_5_part_2_lowest_location_number_with_seed_ranges(): void
    {
        $this->assertEquals(23738616, $this->solver->lowestLocationNumberWithSeedRanges(PuzzleInputs::day5_almanac()));
    }
}

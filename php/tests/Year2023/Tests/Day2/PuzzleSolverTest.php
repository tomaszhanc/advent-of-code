<?php

namespace Advent\Tests\Year2023\Tests\Day2;

use Advent\Shared\Lexer\Lexer;
use Advent\Tests\Shared\Doubles\InMemoryInput;
use Advent\Tests\Year2023\PuzzleInputs;
use Advent\Year2023\Day2\PuzzleSolver;
use Advent\Year2023\Day2\Model\Cubes;
use Advent\Year2023\Day2\Model\CubesSet;
use Advent\Year2023\Day2\Parser\GameParser;
use Advent\Year2023\Day2\Parser\GameTokenType;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PuzzleSolverTest extends TestCase
{
    private PuzzleSolver $solver;

    protected function setUp(): void
    {
        $this->solver = new PuzzleSolver(new GameParser(new Lexer(GameTokenType::class)));
    }

    #[Test]
    public function it_sums_all_game_ids_that_are_possible_to_be_played_out_with_a_given_cubes_set(): void
    {
        $input = new InMemoryInput(
            'Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green',
            'Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue',
            'Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red',
            'Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red',
            'Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green'
        );

        $possibleGameIdsSum = $this->solver->sumAllPossibleGameIdsFor(
            CubesSet::of(
                Cubes::red(12),
                Cubes::green(13),
                Cubes::blue(14)
            ),
            $input
        );

        $this->assertSame(
            1 + 2 + 5, // only games 1, 2 and 5 can be played out
            $possibleGameIdsSum
        );
    }

    #[Test]
    public function it_sums_powers_of_all_smallest_possible_cubes_set_to_play_a_given_game(): void
    {
        $input = new InMemoryInput(
            // smallest cubes set: 4 red, 2 green, 6 blue, power = 48
            'Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green',
            // smallest cubes set: 1 red, 3 green, 4 blue, power = 12
            'Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue',
        );

        $this->assertEquals(
            48 + 12,
            $this->solver->sumPowerOfAllMinimumCubesSetsAllowingToPlayGame($input)
        );
    }

    #[Test]
    public function it_solves_day_2_part_1_sum_all_possible_game_ids_for_the_given_cubes_set(): void
    {
        $cubeSet = CubesSet::of(
            Cubes::red(12),
            Cubes::green(13),
            Cubes::blue(14)
        );

        $this->assertEquals(2551, $this->solver->sumAllPossibleGameIdsFor($cubeSet, PuzzleInputs::day2_gamesRecord()));
    }

    #[Test]
    public function it_solves_day_2_part_2_sum_of_all_minimum_cubes_sets_powers(): void
    {
        $this->assertEquals(62811, $this->solver->sumPowerOfAllMinimumCubesSetsAllowingToPlayGame(PuzzleInputs::day2_gamesRecord()));
    }
}

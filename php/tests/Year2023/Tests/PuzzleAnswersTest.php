<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests;

use Advent\Tests\Year2023\PuzzleInputs;
use Advent\Year2023\Day1\LinesCalibrationValues;
use Advent\Year2023\Day1\Parser\DigitLexer;
use Advent\Year2023\Day1\Parser\DigitLineParser;
use Advent\Year2023\Day2\GameEvaluator;
use Advent\Year2023\Day2\Model\Cubes;
use Advent\Year2023\Day2\Model\CubesSet;
use Advent\Year2023\Day2\Parser\GameLexer;
use Advent\Year2023\Day2\Parser\GameParser;
use Advent\Year2023\Day3\GearsEvaluator;
use Advent\Year2023\Day3\Model\GearsFactory;
use Advent\Year2023\Day3\Model\PartNumbersFactory;
use Advent\Year2023\Day3\Parser\EngineSchematicLexer;
use Advent\Year2023\Day3\Parser\EngineSchematicParser;
use Advent\Year2023\Day3\PartNumbersEvaluator;
use Advent\Year2023\Day4\Parser\ScratchcardLexer;
use Advent\Year2023\Day4\Parser\ScratchcardParser;
use Advent\Year2023\Day4\ScratchcardEvaluator;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @see https://adventofcode.com/2023
 */
final class PuzzleAnswersTest extends TestCase
{
    #[Test]
    public function day_1_part_1_sum_of_all_calibration_values_built_from_numeric_digits_only(): void
    {
        $calibrationValues = new LinesCalibrationValues(new DigitLineParser(DigitLexer::numericDigits()));

        $this->assertEquals(54597, $calibrationValues->sumAllFrom(PuzzleInputs::day1_calibrationDocument()));
    }

    #[Test]
    public function day_1_part_2_sum_of_all_calibration_values_built_from_numeric_and_word_digits(): void
    {
        $calibrationValues = new LinesCalibrationValues(new DigitLineParser(DigitLexer::numericAndWordDigits()));

        $this->assertEquals(54504, $calibrationValues->sumAllFrom(PuzzleInputs::day1_calibrationDocument()));
    }

    #[Test]
    public function day_2_part_1_sum_all_possible_game_ids_for_the_given_cubes_set(): void
    {
        $gameEvaluator = new GameEvaluator(new GameParser(new GameLexer()));
        $cubeSet = CubesSet::of(
            Cubes::red(12),
            Cubes::green(13),
            Cubes::blue(14)
        );

        $this->assertEquals(2551, $gameEvaluator->sumAllPossibleGameIdsFor($cubeSet, PuzzleInputs::day2_gamesRecord()));
    }

    #[Test]
    public function day_2_part_2_sum_of_all_minimum_cubes_sets_powers(): void
    {
        $gameEvaluator = new GameEvaluator(new GameParser(new GameLexer()));

        $this->assertEquals(62811, $gameEvaluator->sumPowerOfAllMinimumCubesSetsAllowingToPlayGame(PuzzleInputs::day2_gamesRecord()));
    }

    #[Test]
    public function day_3_part_1_sum_all_part_numbers(): void
    {
        $partNumbersEvaluator = new PartNumbersEvaluator(
            new EngineSchematicParser(new EngineSchematicLexer()),
            new PartNumbersFactory()
        );

        $this->assertEquals(544433, $partNumbersEvaluator->sumAllPartNumbers(PuzzleInputs::day3_engineSchematic()));
    }

    #[Test]
    public function day_3_part_2_sum_all_gear_ratios(): void
    {
        $gearsEvaluator = new GearsEvaluator(
            new EngineSchematicParser(new EngineSchematicLexer()),
            new GearsFactory()
        );

        $this->assertEquals(76314915, $gearsEvaluator->sumAllGearRatios(PuzzleInputs::day3_engineSchematic()));
    }

    #[Test]
    public function day_4_part_1_sum_all_scratchpads_points(): void
    {
        $scratchcardEvaluator = new ScratchcardEvaluator(new ScratchcardParser(new ScratchcardLexer()));

        $this->assertEquals(23678, $scratchcardEvaluator->sumAllPoints(PuzzleInputs::day4_scratchpadsRecord()));
    }

    #[Test]
    public function day_4_part_2_count_all_won_scratchpads(): void
    {
        $scratchcardEvaluator = new ScratchcardEvaluator(new ScratchcardParser(new ScratchcardLexer()));

        $this->assertEquals(15455663, $scratchcardEvaluator->countAllWonScratchcards(PuzzleInputs::day4_scratchpadsRecord()));
    }
}

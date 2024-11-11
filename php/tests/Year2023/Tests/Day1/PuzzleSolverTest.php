<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day1;

use Advent\Shared\Lexer\Lexer;
use Advent\Tests\Shared\Doubles\InMemoryInput;
use Advent\Tests\Year2023\PuzzleInputs;
use Advent\Year2023\Day1\Parser\WordDigitLexerTokenType;
use Advent\Year2023\Day1\PuzzleSolver;
use Advent\Year2023\Day1\Parser\DigitLexerTokenType;
use Advent\Year2023\Day1\Parser\DigitLineParser;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class LinesCalibrationValuesTest extends TestCase
{
    #[Test]
    public function it_sum_all_lines_calibration_values(): void
    {
        $solver = new PuzzleSolver(new DigitLineParser(new Lexer(
            DigitLexerTokenType::class
        )));
        $file = new InMemoryInput('zoneight234', 'a1b2c3d4e5f');

        $this->assertSame(24 + 15, $solver->sumAllCalibrationValuesFrom($file));
    }

    #[Test]
    public function it_solves_day_1_part_1_sum_of_all_calibration_values_built_from_numeric_digits_only(): void
    {
        $calibrationValues = new PuzzleSolver(new DigitLineParser(new Lexer(
            DigitLexerTokenType::class
        )));

        $this->assertEquals(54597, $calibrationValues->sumAllCalibrationValuesFrom(PuzzleInputs::day1_calibrationDocument()));
    }

    #[Test]
    public function it_solves_day_1_part_2_sum_of_all_calibration_values_built_from_numeric_and_word_digits(): void
    {
        $calibrationValues = new PuzzleSolver(new DigitLineParser(new Lexer(
            DigitLexerTokenType::class,
            WordDigitLexerTokenType::class
        )));

        $this->assertEquals(54504, $calibrationValues->sumAllCalibrationValuesFrom(PuzzleInputs::day1_calibrationDocument()));
    }
}

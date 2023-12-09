<?php

declare(strict_types=1);

namespace AoC\Year2023\Day1;

use AoC\Year2023\Day1\LineCalibrator\SimpleLineCalibrator;
use PHPUnit\Framework\TestCase;

final class SimpleCalibratorTest extends TestCase
{
    /**
     * @dataProvider lines
     */
    public function test_returns_two_digit_number_created_from_the_first_and_the_last_integer_in_the_given_line(string $line, int $expectedCalibrationNumber): void
    {
        $lineCalibrator = new SimpleLineCalibrator();

        $this->assertSame($expectedCalibrationNumber, $lineCalibrator->calibrationNumber($line)->asInteger());
    }

    public static function lines(): \Generator
    {
        yield 'integers are as first and last char' => ['1abc2', 12];
        yield 'integers are in the middle of a line' => ['pqr3stu8vwx', 38];
        yield 'more than 2 integers are present' => ['a1b2c3d4e5f', 15];
        yield 'only one integer is present' => ['treb7uchet', 77];

        yield ['two1nine', 29];
        yield ['eightwothree', 83];
        yield ['eightwo', 82];
        yield ['abcone2threexyz', 13];
        yield ['xtwone3four', 24];
        yield ['4nineeightseven2', 42];
        yield ['zoneight234', 14];
        yield ['7pqrstsixteen', 76];
    }
}

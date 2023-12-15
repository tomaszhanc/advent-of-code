<?php

declare(strict_types=1);

namespace AoC\Year2023\Tests\Day1\LineParser;

use AoC\Year2023\Day1\CalibrationDocument\Line;
use AoC\Year2023\Day1\LineParser\SimpleLineParser;
use PHPUnit\Framework\TestCase;

final class SimpleLineParserTest extends TestCase
{
    /**
     * @dataProvider lines
     */
    public function test_parses_lines_of_integers_and_spelled_out_digits(string $line, Line $expectedLine): void
    {
        $parser = new SimpleLineParser();

        $this->assertEquals($expectedLine, $parser->parse($line));
    }

    public static function lines(): \Generator
    {
        // integers only
        yield ['1abc2', Line::of(1, 2)];
        yield ['pqr3stu8vwx', Line::of(3, 8)];
        yield ['a1b2c3d4e5f', Line::of(1, 2, 3, 4, 5)];
        yield ['treb7uchet', Line::of(7)];

        // integers and spelled out digits
        yield ['two1nine', Line::of(2, 1, 9)];
        yield ['eightwothree', Line::of(8, 2, 3)];
        yield ['eightwo', Line::of(8, 2)];
        yield ['abcone2threexyz', Line::of(1, 2, 3)];
        yield ['xtwone3four', Line::of(2, 1, 3, 4)];
        yield ['4nineeightseven2', Line::of(4, 9, 8, 7, 2)];
        yield ['zoneight234', Line::of(1, 8, 2, 3, 4)];
        yield ['7pqrstsixteen', Line::of(7, 6)];
    }
}

<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day1\Parser;

use Advent\Shared\Lexer\Lexer;
use Advent\Tests\Year2023\Mother\Day1\LineMother;
use Advent\Year2023\Day1\Model\Line;
use Advent\Year2023\Day1\Parser\DigitLexerTokenType;
use Advent\Year2023\Day1\Parser\DigitLineParser;
use Advent\Year2023\Day1\Parser\WordDigitLexerTokenType;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class DigitLineParserTest extends TestCase
{
    #[Test]
    #[DataProvider('scenario_with_numeric_digits_only')]
    public function it_parses_lines_of_numeric_digits_only(string $line, Line $expectedLine): void
    {
        $parser = new DigitLineParser(new Lexer(DigitLexerTokenType::class));

        $this->assertEquals($expectedLine, $parser->parse($line));
    }

    public static function scenario_with_numeric_digits_only(): iterable
    {
        yield ['1abc2', LineMother::create(1, 2)];
        yield ['pqr3stu8vwx', LineMother::create(3, 8)];
        yield ['a1b2c3d4e5f', LineMother::create(1, 2, 3, 4, 5)];
        yield ['treb7uchet', LineMother::create(7)];
        yield ['two1nine', LineMother::create(1)];
        yield ['abcone2threexyz', LineMother::create(2)];
        yield ['xtwone3four', LineMother::create(3)];
        yield ['4nineeightseven2', LineMother::create(4, 2)];
        yield ['zoneight234', LineMother::create(2, 3, 4)];
        yield ['7pqrstsixteen', LineMother::create(7)];
    }

    #[Test]
    #[DataProvider('scenario_with_numeric_and_word_digits')]
    public function it_parses_lines_of_numeric_and_word_digits(string $line, Line $expectedLine): void
    {
        $parser = new DigitLineParser(new Lexer(DigitLexerTokenType::class, WordDigitLexerTokenType::class));

        $this->assertEquals($expectedLine, $parser->parse($line));
    }

    public static function scenario_with_numeric_and_word_digits(): iterable
    {
        // integers only
        yield ['1abc2', LineMother::create(1, 2)];
        yield ['pqr3stu8vwx', LineMother::create(3, 8)];
        yield ['a1b2c3d4e5f', LineMother::create(1, 2, 3, 4, 5)];
        yield ['treb7uchet', LineMother::create(7)];

        // integers and spelled out digits
        yield ['two1nine', LineMother::create(2, 1, 9)];
        yield ['eightwothree', LineMother::create(8, 2, 3)];
        yield ['eightwo', LineMother::create(8, 2)];
        yield ['abcone2threexyz', LineMother::create(1, 2, 3)];
        yield ['xtwone3four', LineMother::create(2, 1, 3, 4)];
        yield ['4nineeightseven2', LineMother::create(4, 9, 8, 7, 2)];
        yield ['zoneight234', LineMother::create(1, 8, 2, 3, 4)];
        yield ['7pqrstsixteen', LineMother::create(7, 6)];
    }
}

<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day5\Parser;

use Advent\Shared\Lexer\Lexer;
use Advent\Tests\Shared\Assertion\Lexer\SimplifiedToken;
use Advent\Tests\Shared\Assertion\Lexer\TokenAssertion;
use Advent\Year2023\Day5\Parser\AlmanacType;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class AlmanacLexerTokenTypeTest extends TestCase
{
    use TokenAssertion;

    #[Test]
    public function it_tokenizes_almanac(): void
    {
        $lexer = new Lexer(AlmanacType::class);
        $input = file_get_contents(__DIR__ . '/../../../Resources/test_day5.txt');

        $this->assertTokensAreEqual(
            [
                new SimplifiedToken('seeds', AlmanacType::SEEDS),
                new SimplifiedToken('79', AlmanacType::NUMBER),
                new SimplifiedToken('14', AlmanacType::NUMBER),
                new SimplifiedToken('55', AlmanacType::NUMBER),
                new SimplifiedToken('13', AlmanacType::NUMBER),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),

                new SimplifiedToken('seed-to-soil map', AlmanacType::MAP),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),
                new SimplifiedToken('50', AlmanacType::NUMBER),
                new SimplifiedToken('98', AlmanacType::NUMBER),
                new SimplifiedToken('2', AlmanacType::NUMBER),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),
                new SimplifiedToken('52', AlmanacType::NUMBER),
                new SimplifiedToken('50', AlmanacType::NUMBER),
                new SimplifiedToken('48', AlmanacType::NUMBER),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),

                new SimplifiedToken('soil-to-fertilizer map', AlmanacType::MAP),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),
                new SimplifiedToken('0', AlmanacType::NUMBER),
                new SimplifiedToken('15', AlmanacType::NUMBER),
                new SimplifiedToken('37', AlmanacType::NUMBER),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),
                new SimplifiedToken('37', AlmanacType::NUMBER),
                new SimplifiedToken('52', AlmanacType::NUMBER),
                new SimplifiedToken('2', AlmanacType::NUMBER),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),
                new SimplifiedToken('39', AlmanacType::NUMBER),
                new SimplifiedToken('0', AlmanacType::NUMBER),
                new SimplifiedToken('15', AlmanacType::NUMBER),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),

                new SimplifiedToken('fertilizer-to-water map', AlmanacType::MAP),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),
                new SimplifiedToken('49', AlmanacType::NUMBER),
                new SimplifiedToken('53', AlmanacType::NUMBER),
                new SimplifiedToken('8', AlmanacType::NUMBER),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),
                new SimplifiedToken('0', AlmanacType::NUMBER),
                new SimplifiedToken('11', AlmanacType::NUMBER),
                new SimplifiedToken('42', AlmanacType::NUMBER),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),
                new SimplifiedToken('42', AlmanacType::NUMBER),
                new SimplifiedToken('0', AlmanacType::NUMBER),
                new SimplifiedToken('7', AlmanacType::NUMBER),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),
                new SimplifiedToken('57', AlmanacType::NUMBER),
                new SimplifiedToken('7', AlmanacType::NUMBER),
                new SimplifiedToken('4', AlmanacType::NUMBER),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),

                new SimplifiedToken('water-to-light map', AlmanacType::MAP),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),
                new SimplifiedToken('88', AlmanacType::NUMBER),
                new SimplifiedToken('18', AlmanacType::NUMBER),
                new SimplifiedToken('7', AlmanacType::NUMBER),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),
                new SimplifiedToken('18', AlmanacType::NUMBER),
                new SimplifiedToken('25', AlmanacType::NUMBER),
                new SimplifiedToken('70', AlmanacType::NUMBER),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),

                new SimplifiedToken('light-to-temperature map', AlmanacType::MAP),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),
                new SimplifiedToken('45', AlmanacType::NUMBER),
                new SimplifiedToken('77', AlmanacType::NUMBER),
                new SimplifiedToken('23', AlmanacType::NUMBER),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),
                new SimplifiedToken('81', AlmanacType::NUMBER),
                new SimplifiedToken('45', AlmanacType::NUMBER),
                new SimplifiedToken('19', AlmanacType::NUMBER),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),
                new SimplifiedToken('68', AlmanacType::NUMBER),
                new SimplifiedToken('64', AlmanacType::NUMBER),
                new SimplifiedToken('13', AlmanacType::NUMBER),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),

                new SimplifiedToken('temperature-to-humidity map', AlmanacType::MAP),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),
                new SimplifiedToken('0', AlmanacType::NUMBER),
                new SimplifiedToken('69', AlmanacType::NUMBER),
                new SimplifiedToken('1', AlmanacType::NUMBER),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),
                new SimplifiedToken('1', AlmanacType::NUMBER),
                new SimplifiedToken('0', AlmanacType::NUMBER),
                new SimplifiedToken('69', AlmanacType::NUMBER),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),

                new SimplifiedToken('humidity-to-location map', AlmanacType::MAP),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),
                new SimplifiedToken('60', AlmanacType::NUMBER),
                new SimplifiedToken('56', AlmanacType::NUMBER),
                new SimplifiedToken('37', AlmanacType::NUMBER),
                new SimplifiedToken(PHP_EOL, AlmanacType::NEW_LINE),
                new SimplifiedToken('56', AlmanacType::NUMBER),
                new SimplifiedToken('93', AlmanacType::NUMBER),
                new SimplifiedToken('4', AlmanacType::NUMBER),
            ],
            iterator_to_array($lexer->tokenize($input))
        );
    }
}

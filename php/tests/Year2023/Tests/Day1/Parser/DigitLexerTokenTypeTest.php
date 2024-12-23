<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day1\Parser;

use Advent\Shared\Lexer\Lexer;
use Advent\Shared\Lexer\Token;
use Advent\Year2023\Day1\Parser\DigitLexerTokenType;
use Advent\Year2023\Day1\Parser\WordDigitLexerTokenType;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class DigitLexerTokenTypeTest extends TestCase
{
    #[Test]
    public function it_tokenizes_numeric_digits(): void
    {
        $lexer = new Lexer(DigitLexerTokenType::class);

        $this->assertEquals(
            [
                new Token('1', DigitLexerTokenType::DIGIT, 3),
            ],
            iterator_to_array($lexer->tokenize('two1nine'))
        );
    }

    #[Test]
    public function it_tokenizes_number_and_word_digits(): void
    {
        $lexer = new Lexer(
            DigitLexerTokenType::class,
            WordDigitLexerTokenType::class
        );

        $this->assertEquals(
            [
                new Token('two', WordDigitLexerTokenType::WORD_DIGIT, 0),
                new Token('1', DigitLexerTokenType::DIGIT, 3),
                new Token('nine', WordDigitLexerTokenType::WORD_DIGIT, 4),
            ],
            iterator_to_array($lexer->tokenize('two1nine'))
        );

        $this->assertEquals(
            [
                new Token('eight', WordDigitLexerTokenType::WORD_DIGIT, 0),
                new Token('two', WordDigitLexerTokenType::WORD_DIGIT, 4),
                new Token('three', WordDigitLexerTokenType::WORD_DIGIT, 7),
            ],
            iterator_to_array($lexer->tokenize('eightwothree'))
        );
    }
}

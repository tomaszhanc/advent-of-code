<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day4\Parser;

use Advent\Shared\Lexer\Token;
use Advent\Year2023\Day4\Parser\ScratchcardLexer;
use Advent\Year2023\Day4\Parser\ScratchcardType;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ScratchcardLexerTest extends TestCase
{
    #[Test]
    public function it_tokenizes_scratchcard(): void
    {
        $lexer = new ScratchcardLexer();

        $line = 'Card 1: 41 48 83 86 17 | 83 86  6 31 17  9 48 53';

        $this->assertEquals(
            [
                new Token('Card', ScratchcardType::CARD, 0),
                new Token('1', ScratchcardType::NUMBER, 5),
                new Token('41', ScratchcardType::NUMBER, 8),
                new Token('48', ScratchcardType::NUMBER, 11),
                new Token('83', ScratchcardType::NUMBER, 14),
                new Token('86', ScratchcardType::NUMBER, 17),
                new Token('17', ScratchcardType::NUMBER, 20),
                new Token('|', ScratchcardType::BAR, 23),
                new Token('83', ScratchcardType::NUMBER, 25),
                new Token('86', ScratchcardType::NUMBER, 28),
                new Token('6', ScratchcardType::NUMBER, 32),
                new Token('31', ScratchcardType::NUMBER, 34),
                new Token('17', ScratchcardType::NUMBER, 37),
                new Token('9', ScratchcardType::NUMBER, 41),
                new Token('48', ScratchcardType::NUMBER, 43),
                new Token('53', ScratchcardType::NUMBER, 46),

            ],
            iterator_to_array($lexer->tokenize($line))
        );
    }
}

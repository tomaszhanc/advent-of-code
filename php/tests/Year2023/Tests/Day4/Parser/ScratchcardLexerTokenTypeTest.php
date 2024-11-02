<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day4\Parser;

use Advent\Shared\Lexer\Lexer;
use Advent\Tests\Shared\Assertion\Lexer\SimplifiedToken;
use Advent\Tests\Shared\Assertion\Lexer\TokenAssertion;
use Advent\Year2023\Day4\Parser\ScratchcardType;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ScratchcardLexerTokenTypeTest extends TestCase
{
    use TokenAssertion;

    #[Test]
    public function it_tokenizes_scratchcard(): void
    {
        $lexer = new Lexer(ScratchcardType::class);

        $line = 'Card 1: 41 48 83 86 17 | 83 86  6 31 17  9 48 53';

        $this->assertTokensAreEqual(
            [
                new SimplifiedToken('Card', ScratchcardType::CARD),
                new SimplifiedToken('1', ScratchcardType::NUMBER),
                new SimplifiedToken('41', ScratchcardType::NUMBER),
                new SimplifiedToken('48', ScratchcardType::NUMBER),
                new SimplifiedToken('83', ScratchcardType::NUMBER),
                new SimplifiedToken('86', ScratchcardType::NUMBER),
                new SimplifiedToken('17', ScratchcardType::NUMBER),
                new SimplifiedToken('|', ScratchcardType::BAR),
                new SimplifiedToken('83', ScratchcardType::NUMBER),
                new SimplifiedToken('86', ScratchcardType::NUMBER),
                new SimplifiedToken('6', ScratchcardType::NUMBER),
                new SimplifiedToken('31', ScratchcardType::NUMBER),
                new SimplifiedToken('17', ScratchcardType::NUMBER),
                new SimplifiedToken('9', ScratchcardType::NUMBER),
                new SimplifiedToken('48', ScratchcardType::NUMBER),
                new SimplifiedToken('53', ScratchcardType::NUMBER),

            ],
            iterator_to_array($lexer->tokenize($line))
        );
    }
}

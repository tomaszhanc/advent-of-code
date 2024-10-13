<?php

declare(strict_types=1);

namespace Advent\Year2023\Day1\Parser;

use Advent\Shared\Lexer\Lexer;
use Advent\Shared\Lexer\LexerBuilder;

final readonly class DigitLexer
{
    public function __construct(
        private Lexer $lexer
    ) {
    }

    /**
     * @throws \Exception
     */
    public static function numericDigitsOnly(): self
    {
        return new self(
            (new LexerBuilder())
            ->readTokenTypesFrom(DigitLexerTokenType::class)
            ->build()
        );
    }

    /**
     * @throws \Exception
     */
    public static function numericAndWordDigits(): self
    {
        return new self(
            (new LexerBuilder())
            ->readTokenTypesFrom(DigitLexerTokenType::class)
            ->readTokenTypesFrom(WordDigitLexerTokenType::class)
            ->build()
        );
    }

    public function tokenize(string $input): iterable
    {
        return $this->lexer->tokenize($input);
    }
}

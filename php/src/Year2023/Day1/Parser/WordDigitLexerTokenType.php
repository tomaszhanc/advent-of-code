<?php

declare(strict_types=1);

namespace Advent\Year2023\Day1\Parser;

use Advent\Shared\Lexer\Attributes\Regex;

enum WordDigitLexerTokenType
{
    #[Regex("zero|one|two|three|four|five|six|seven|eight|nine", positiveLookahead: true)]
    case WORD_DIGIT;

    public function isDigit(): bool
    {
        return $this === self::WORD_DIGIT;
    }
}

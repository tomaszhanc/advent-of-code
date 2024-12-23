<?php

declare(strict_types=1);

namespace Advent\Year2023\Day1\Parser;

use Advent\Shared\Lexer\Attributes\Regex;

enum DigitLexerTokenType
{
    #[Regex("\d")]
    case DIGIT;

    public function isDigit(): bool
    {
        return $this === self::DIGIT;
    }
}

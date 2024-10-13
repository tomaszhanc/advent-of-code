<?php

declare(strict_types=1);

namespace Advent\Year2023\Day1\Parser;

use Advent\Year2023\Day1\Digit;
use Advent\Year2023\Day1\Line;

final readonly class DigitLineParser
{
    public function __construct(
        private DigitLexer $lexer
    ) {
    }

    public function parse(string $line): Line
    {
        $digits = [];

        foreach ($this->lexer->tokenize($line) as $token) {
            if ($token->type->isDigit()) {
                $digits[] = Digit::fromString($token->value);
            }
        }

        return Line::create(...$digits);
    }
}

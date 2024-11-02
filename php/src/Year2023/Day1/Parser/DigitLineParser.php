<?php

declare(strict_types=1);

namespace Advent\Year2023\Day1\Parser;

use Advent\Shared\Lexer\LexerInterface;
use Advent\Year2023\Day1\Model\Digit;
use Advent\Year2023\Day1\Model\Line;

final readonly class DigitLineParser
{
    public function __construct(
        private LexerInterface $lexer
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

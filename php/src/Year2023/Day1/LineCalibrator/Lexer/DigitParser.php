<?php

declare(strict_types=1);

namespace AoC\Year2023\Day1\LineCalibrator\Lexer;

use AoC\Year2023\Day1\Digit;

final class DigitParser
{
    /**
     * @return Digit[]
     */
    public function parse(string $input) : array
    {
        $lexer = new DigitLexer($input);
        $digits = [];

        while (true) {
            $lexer->moveNext();
            $lexer->skipUntil(TokenType::SINGLE_DIGIT);

            if ($lexer->lookahead === null) {
                break;
            }

            $digits[] = Digit::fromString($lexer->lookahead->value);
        }

        return $digits;
    }
}

<?php

declare(strict_types=1);

namespace AoC\Year2023\Day1;

use AoC\Common\LineParser;
use AoC\Year2023\Day1\CalibrationDocument\Digit;
use AoC\Year2023\Day1\CalibrationDocument\Line;
use AoC\Year2023\Day1\LineParser\DigitsLexer;
use AoC\Year2023\Day1\LineParser\Type;

/**
 * @template-implements LineParser<Line>
 */
final readonly class LexerLineParser implements LineParser
{
    private function __construct(
        private DigitsLexer $lexer
    ) {
    }

    public static function recognizeIntegers(): self
    {
        return new self(DigitsLexer::recognizeIntegers());
    }

    public static function recognizeIntegersAndSpelledOutDigits(): self
    {
        return new self(DigitsLexer::recognizeIntegersAndSpelledOutDigits());
    }

    public function parse(string $line): Line
    {
        $this->lexer->setInput($line);
        $digits = [];

        while (true) {
            $this->lexer->moveNext();
            $this->lexer->skipUntil(Type::T_SINGLE_DIGIT);

            if ($this->lexer->lookahead === null) {
                break;
            }

            $digits[] = Digit::fromString($this->lexer->lookahead->value);
        }

        return Line::create(...$digits);
    }
}
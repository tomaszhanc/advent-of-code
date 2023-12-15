<?php

declare(strict_types=1);

namespace AoC\Year2023\Day1;

use AoC\Common\Parser;
use AoC\Year2023\Day1\CalibrationDocument\Digit;
use AoC\Year2023\Day1\CalibrationDocument\Line;
use AoC\Year2023\Day1\LineParser\DigitsLexer;
use AoC\Year2023\Day1\LineParser\Type;

/**
 * @template-implements Parser<Line>
 */
final readonly class LexerLineParser implements Parser
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

    public function parse(string $input): Line
    {
        $this->lexer->setInput($input);
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

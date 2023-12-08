<?php

declare(strict_types=1);

namespace AoC\Year2023\Day1\LineCalibrator\Lexer;

use Doctrine\Common\Lexer\AbstractLexer;

final class DigitLexer extends AbstractLexer
{
    public function __construct(string $input)
    {
        $this->setInput($input);
    }

    protected function getCatchablePatterns() : array
    {
        return [
            '(?=(\d|one|two|three|four|five|six|seven|eight|nine))',
        ];
    }

    protected function getNonCatchablePatterns() : array
    {
        return [];
    }

    protected function getType(string &$value) : TokenType
    {
        if (\is_numeric($value) || \in_array($value, ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'], true)) {
            return TokenType::SINGLE_DIGIT;
        }

        return TokenType::NONE;
    }
}

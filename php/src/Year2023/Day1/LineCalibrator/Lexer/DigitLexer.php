<?php

declare(strict_types=1);

namespace AoC\Year2023\Day1\LineCalibrator\Lexer;

use Doctrine\Common\Lexer\AbstractLexer;

/**
 * @template-extends AbstractLexer<Type, string>
 */
final class DigitLexer extends AbstractLexer
{
    public function __construct(string $input)
    {
        $this->setInput($input);
    }

    protected function getCatchablePatterns(): array
    {
        return [
            '(?=(\d|one|two|three|four|five|six|seven|eight|nine))',
        ];
    }

    protected function getNonCatchablePatterns(): array
    {
        return [];
    }

    protected function getType(string &$value): Type
    {
        if (\is_numeric($value) || \in_array($value, ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'], true)) {
            return Type::T_SINGLE_DIGIT;
        }

        return Type::T_NONE;
    }
}

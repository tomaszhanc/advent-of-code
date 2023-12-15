<?php

declare(strict_types=1);

namespace AoC\Year2023\Day1\LineParser\Lexer;

use Doctrine\Common\Lexer\AbstractLexer;

/**
 * @template-extends AbstractLexer<Type, string>
 */
final class DigitsLexer extends AbstractLexer
{
    /**
     * @param string[] $catchablePatterns
     */
    private function __construct(private readonly array $catchablePatterns)
    {
    }

    protected function getCatchablePatterns(): array
    {
        return $this->catchablePatterns;
    }

    public static function recognizeIntegers(): self
    {
        return new self([
            '\d'
        ]);
    }

    public static function recognizeIntegersAndSpelledOutDigits(): self
    {
        return new self([
            '\d',
            '?=(one|two|three|four|five|six|seven|eight|nine)',
        ]);
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

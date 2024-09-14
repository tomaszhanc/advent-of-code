<?php

declare(strict_types=1);

namespace Advent\Year2023\Day3\EngineElementsParser;

use Doctrine\Common\Lexer\AbstractLexer;

/**
 * @template-extends AbstractLexer<Type, string>
 */
final class EngineElementsLexer extends AbstractLexer
{
    protected function getCatchablePatterns(): array
    {
        return [
            '\d+',
            '[^a-zA-Z0-9\.]', // all symbols that are not letters, numbers or dots
        ];
    }

    protected function getNonCatchablePatterns(): array
    {
        return [
            '[ \.]', // skip spaces, dots
        ];
    }

    protected function getType(string &$value): Type
    {
        if (\is_numeric($value)) {
            return Type::T_NUMBER;
        }

        return Type::T_SYMBOL;
    }
}

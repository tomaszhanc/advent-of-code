<?php

declare(strict_types=1);

namespace AoC\Year2023\Day2\Lexer;

use Doctrine\Common\Lexer\AbstractLexer;

/**
 * @template-extends AbstractLexer<Type, string>
 */
final class GameLexer extends AbstractLexer
{
    protected function getCatchablePatterns(): array
    {
        return [
            'Game|blue|red|green',
            '\d+',
            ';',
        ];
    }

    protected function getNonCatchablePatterns(): array
    {
        return ['\s+', '[:,]'];
    }

    protected function getType(string &$value): Type
    {
        return match (true) {
            \str_starts_with($value, 'Game') => Type::T_GAME,
            \is_numeric($value) => Type::T_NUMBER,
            \in_array($value, ['blue', 'red', 'green']) => Type::T_COLOR,
            $value === ';' => Type::T_SEMICOLON,
            default => Type::T_NONE,
        };
    }
}

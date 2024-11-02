<?php

declare(strict_types=1);

namespace Advent\Shared\Lexer;

/**
 * @template T of \UnitEnum
 */
interface LexerInterface
{
    /**
     * @return Tokens<Token<T>>
     */
    public function tokenize(string $input): Tokens;
}

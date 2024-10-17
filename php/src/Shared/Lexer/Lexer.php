<?php

declare(strict_types=1);

namespace Advent\Shared\Lexer;

use Advent\Shared\Lexer\Doctrine\DoctrineLexer;

/**
 * @template T of \UnitEnum
 */
final readonly class Lexer
{
    /** @param DoctrineLexer<T> $lexer */
    public function __construct(private DoctrineLexer $lexer)
    {
    }

    /**
     * @return Tokens<T>
     */
    public function tokenize(string $input): Tokens
    {
        $this->lexer->setInput($input);
        $this->lexer->moveNext();

        return new Tokens($this->lexer);
    }
}

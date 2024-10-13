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
     * @return Token<T>[]
     */
    public function tokenize(string $input): iterable
    {
        $this->lexer->setInput($input);

        while ($this->lexer->moveNext()) {
            $token = $this->lexer->lookahead;

            if ($token->type !== null) {
                yield new Token(
                    $token->value,
                    $token->type,
                    $token->position
                );
            }
        }
    }
}

<?php

declare(strict_types=1);

namespace Advent\Shared\Lexer;

use Advent\Shared\Lexer\Doctrine\DoctrineLexer;

/**
 * @template T of \UnitEnum
 * @template-implements \IteratorAggregate<int, Token<T>>
 *
 */
final readonly class Tokens implements \IteratorAggregate
{
    /** @param DoctrineLexer<T> $lexer */
    public function __construct(private DoctrineLexer $lexer)
    {
    }

    /** @return ?Token<T> */
    public function current(): ?Token
    {
        $token = $this->lexer->token;

        if ($token === null) {
            return null;
        }

        return new Token(
            $token->value,
            $token->type,
            $token->position
        );
    }

    /** @return ?Token<T> */
    public function next(): ?Token
    {
        do {
            $this->lexer->moveNext();
            $token = $this->current();
        } while ($token !== null && $token->type === null);

        return $token;
    }

    // FIXME add tests
    public function skipUntil(\UnitEnum $type): ?Token
    {
        if ($this->current() === null) {
            $this->next();
        }

        while ($this->current() !== null && !$this->current()->isA($type)) {
            $this->next();
        }

        return $this->current();
    }

    public function hasMore(): bool
    {
        return $this->current() !== null || $this->next() !== null;
    }

    /**
     * @return Token[]
     */
    public function getIterator(): \Traversable
    {
        while ($this->next()) {
            yield $this->current();
        }
    }
}

<?php

declare(strict_types=1);

namespace Advent\Shared\Lexer;

use Doctrine\Common\Lexer\AbstractLexer;

final readonly class Lexer
{
    public function __construct(private AbstractLexer $lexer)
    {
    }

    public function tokenize(string $input): iterable
    {
        $this->lexer->setInput($input);

        while ($this->lexer->moveNext()) {
            $token = $this->lexer->lookahead;

            if ($token->type !== null) {
                yield $token;
            }
        }
    }
}

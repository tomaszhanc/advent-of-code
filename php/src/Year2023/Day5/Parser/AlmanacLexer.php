<?php

declare(strict_types=1);

namespace Advent\Year2023\Day5\Parser;

use Advent\Shared\Lexer\LexerBuilder;
use Advent\Shared\Lexer\Token;
use Advent\Shared\Lexer\Tokens;

final readonly class AlmanacLexer
{
    /**
     * @return Tokens<Token<AlmanacType>>
     * @throws \Exception
     */
    public function tokenize(string $input): Tokens
    {
        return (new LexerBuilder())
            ->readTokenTypesFrom(AlmanacType::class)
            ->build()
            ->tokenize($input);
    }
}

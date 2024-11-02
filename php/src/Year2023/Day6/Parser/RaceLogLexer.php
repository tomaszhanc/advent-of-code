<?php

declare(strict_types=1);

namespace Advent\Year2023\Day6\Parser;

use Advent\Shared\Lexer\LexerBuilder;
use Advent\Shared\Lexer\Token;
use Advent\Shared\Lexer\Tokens;

final readonly class RaceLogLexer
{
    /**
     * @return Tokens<Token<RaceLogType>>
     * @throws \Exception
     */
    public function tokenize(string $input): Tokens
    {
        return (new LexerBuilder())
            ->readTokenTypesFrom(RaceLogType::class)
            ->build()
            ->tokenize($input);
    }
}

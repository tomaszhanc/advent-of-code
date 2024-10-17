<?php

declare(strict_types=1);

namespace Advent\Year2023\Day2\Parser;

use Advent\Shared\Lexer\LexerBuilder;
use Advent\Shared\Lexer\Token;
use Advent\Shared\Lexer\Tokens;

final readonly class GameLexer
{
    /**
     * @return Tokens<Token<GameTokenType>>
     * @throws \Exception
     */
    public function tokenize(string $input): Tokens
    {
        return (new LexerBuilder())
            ->readTokenTypesFrom(GameTokenType::class)
            ->build()
            ->tokenize($input);
    }
}

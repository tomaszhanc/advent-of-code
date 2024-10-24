<?php

declare(strict_types=1);

namespace Advent\Year2023\Day4\Parser;

use Advent\Shared\Lexer\LexerBuilder;
use Advent\Shared\Lexer\Token;
use Advent\Shared\Lexer\Tokens;

final readonly class ScratchcardLexer
{
    /**
     * @return Tokens<Token<ScratchcardType>>
     * @throws \Exception
     */
    public function tokenize(string $input): Tokens
    {
        return (new LexerBuilder())
            ->readTokenTypesFrom(ScratchcardType::class)
            ->build()
            ->tokenize($input);
    }
}

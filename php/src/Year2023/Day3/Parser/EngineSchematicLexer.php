<?php

declare(strict_types=1);

namespace Advent\Year2023\Day3\Parser;

use Advent\Shared\Lexer\LexerBuilder;
use Advent\Shared\Lexer\Token;
use Advent\Shared\Lexer\Tokens;

final readonly class EngineSchematicLexer
{
    /**
     * @return Tokens<Token<EngineSchematicType>>
     * @throws \Exception
     */
    public function tokenize(string $input): Tokens
    {
        return (new LexerBuilder())
            ->readTokenTypesFrom(EngineSchematicType::class)
            ->build()
            ->tokenize($input);
    }
}

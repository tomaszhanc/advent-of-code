<?php

declare(strict_types=1);

namespace Advent\Year2023\Day2\Parser;

use Advent\Shared\Lexer\LexerBuilder;

final readonly class Day2Lexer
{
    public function tokenize(string $input): iterable
    {
        return (new LexerBuilder())
            ->readTokenTypesFrom()
            ->build()
            ->tokenize($input);
    }
}

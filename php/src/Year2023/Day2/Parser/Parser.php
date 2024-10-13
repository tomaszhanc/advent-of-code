<?php
declare(strict_types=1);

namespace Advent\Year2023\Day2\Parser;

final readonly class Parser
{
    public function __construct(private Day2Lexer $lexer)
    {
    }

    public function parse(string $line)
    {
        foreach ($this->lexer->tokenize($line) as $token) {
            $token->
        }
    }
}
<?php

declare(strict_types=1);

namespace Advent\Tests\Shared\Assertion\Lexer;

use Advent\Shared\Lexer\Token;

trait TokenAssertion
{
    /**
     * @param array<SimplifiedToken> $expected
     * @param array<Token> $actual
     */
    private function assertTokensAreEqual(array $expected, array $actual): void
    {
        $this->assertEquals(
            array_map(fn (SimplifiedToken $token) => [$token->value, $token->type], $expected),
            array_map(fn (Token $token) => [$token->value, $token->type], $actual),
        );
    }
}

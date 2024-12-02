<?php

declare(strict_types=1);

namespace Advent\Tests\Year2024\Tests\Day2\Parser;

use Advent\Shared\Lexer\Lexer;
use Advent\Tests\Shared\Assertion\Lexer\SimplifiedToken;
use Advent\Tests\Shared\Assertion\Lexer\TokenAssertion;
use Advent\Year2024\Day2\Parser\BlaType;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class LexerBlaTypeTestTest extends TestCase
{
    use TokenAssertion;

    #[Test]
    public function it_tokenizes_(): void
    {
        $lexer = new Lexer(BlaType::class);
        $input = 'Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green';

        $this->assertTokensAreEqual(
            [
                new SimplifiedToken('Game', BlaType::GAME),
                new SimplifiedToken('1', BlaType::NUMBER),
                new SimplifiedToken('3', BlaType::NUMBER),
                new SimplifiedToken('blue', BlaType::COLOR),
                new SimplifiedToken('4', BlaType::NUMBER),
                new SimplifiedToken('red', BlaType::COLOR),
                new SimplifiedToken(';', BlaType::SEMICOLON),
            ],
            iterator_to_array($lexer->tokenize($input)),
        );
    }
}

<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Unit\Day2\Parser;

use Advent\Shared\Lexer\Token;
use Advent\Year2023\Day2\Parser\GameLexer;
use Advent\Year2023\Day2\Parser\GameTokenType;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class GameLexerTest extends TestCase
{
    #[Test]
    public function it_tokenizes_game_record(): void
    {
        $lexer = new GameLexer();

        $this->assertEquals(
            [
                new Token('Game', GameTokenType::GAME, 0),
                new Token('1', GameTokenType::NUMBER, 5),
                new Token('3', GameTokenType::NUMBER, 8),
                new Token('blue', GameTokenType::COLOR, 10),
                new Token('4', GameTokenType::NUMBER, 16),
                new Token('red', GameTokenType::COLOR, 18),
                new Token(';', GameTokenType::SEMICOLON, 21),
                new Token('1', GameTokenType::NUMBER, 23),
                new Token('red', GameTokenType::COLOR, 25),
                new Token('2', GameTokenType::NUMBER, 30),
                new Token('green', GameTokenType::COLOR, 32),
                new Token('6', GameTokenType::NUMBER, 39),
                new Token('blue', GameTokenType::COLOR, 41),
                new Token(';', GameTokenType::SEMICOLON, 45),
                new Token('2', GameTokenType::NUMBER, 47),
                new Token('green', GameTokenType::COLOR, 49),
            ],
            iterator_to_array($lexer->tokenize('Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green')),
        );
    }
}

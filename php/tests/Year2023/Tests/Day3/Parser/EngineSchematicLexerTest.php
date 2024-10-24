<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day3\Parser;

use Advent\Shared\Lexer\Token;
use Advent\Year2023\Day3\Parser\EngineSchematicLexer;
use Advent\Year2023\Day3\Parser\EngineSchematicType;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class EngineSchematicLexerTest extends TestCase
{
    #[Test]
    #[DataProvider('lines')]
    public function it_tokenizes_engine_schematic(string $line, Token ...$expectedTokens): void
    {
        $lexer = new EngineSchematicLexer();

        $this->assertEquals($expectedTokens, iterator_to_array($lexer->tokenize($line)));
    }

    public static function lines(): iterable
    {
        yield [
            '467..114..',
            new Token('467', EngineSchematicType::NUMBER, 0),
            new Token('114', EngineSchematicType::NUMBER, 5),
        ];

        yield [
            '...*......',
            new Token('*', EngineSchematicType::SYMBOL, 3),
        ];

        yield [
            '..35..633.',
            new Token('35', EngineSchematicType::NUMBER, 2),
            new Token('633', EngineSchematicType::NUMBER, 6),
        ];

        yield [
            '......#...',
            new Token('#', EngineSchematicType::SYMBOL, 6),
        ];

        yield [
            '17*......',
            new Token('17', EngineSchematicType::NUMBER, 0),
            new Token('*', EngineSchematicType::SYMBOL, 2),
        ];

        yield [
            '....+.58.',
            new Token('+', EngineSchematicType::SYMBOL, 4),
            new Token('58', EngineSchematicType::NUMBER, 6),
        ];

        yield [
            '..592.....',
            new Token('592', EngineSchematicType::NUMBER, 2),
        ];

        yield [
            '......755.',
            new Token('755', EngineSchematicType::NUMBER, 6),
        ];

        yield [
            '...$.*....',
            new Token('$', EngineSchematicType::SYMBOL, 3),
            new Token('*', EngineSchematicType::SYMBOL, 5),
        ];

        yield [
            '.664.598..',
            new Token('664', EngineSchematicType::NUMBER, 1),
            new Token('598', EngineSchematicType::NUMBER, 5),
        ];
    }
}

<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day10\Parser;

use Advent\Shared\Lexer\Lexer;
use Advent\Shared\Lexer\Token;
use Advent\Year2023\Day10\Parser\PipeType;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class LexerPipeTypeTestTest extends TestCase
{
    #[Test]
    #[DataProvider('lines')]
    public function it_tokenizes_pipes(string $line, array $expectedTokens): void
    {
        $lexer = new Lexer(PipeType::class);

        $this->assertEquals($expectedTokens, iterator_to_array($lexer->tokenize($line)));
    }

    public static function lines(): iterable
    {
        yield [
            '..F7.',
            [
                new Token('F', PipeType::PIPE, 2),
                new Token('7', PipeType::PIPE, 3),
            ],
        ];

        yield [
            '.FJ|.',
            [
                new Token('F', PipeType::PIPE, 1),
                new Token('J', PipeType::PIPE, 2),
                new Token('|', PipeType::PIPE, 3),
            ],
        ];

        yield [
            'SJ.L7',
            [
                new Token('S', PipeType::START, 0),
                new Token('J', PipeType::PIPE, 1),
                new Token('L', PipeType::PIPE, 3),
                new Token('7', PipeType::PIPE, 4),
            ],
        ];

        yield [
            '|F--J',
            [
                new Token('|', PipeType::PIPE, 0),
                new Token('F', PipeType::PIPE, 1),
                new Token('-', PipeType::PIPE, 2),
                new Token('-', PipeType::PIPE, 3),
                new Token('J', PipeType::PIPE, 4),
            ],
        ];

        yield [
            'LJ...',
            [
                new Token('L', PipeType::PIPE, 0),
                new Token('J', PipeType::PIPE, 1),
            ],
        ];
    }
}

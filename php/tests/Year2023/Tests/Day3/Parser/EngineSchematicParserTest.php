<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day3\Parser;

use Advent\Shared\Lexer\Lexer;
use Advent\Year2023\Day3\Model\Element\Elements;
use Advent\Year2023\Day3\Model\Element\NumberElement;
use Advent\Year2023\Day3\Model\Element\SymbolElement;
use Advent\Year2023\Day3\Parser\EngineSchematicParser;
use Advent\Year2023\Day3\Parser\EngineSchematicType;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class EngineSchematicParserTest extends TestCase
{
    #[Test]
    #[DataProvider('lines')]
    public function it_parses_engine_schematic(int $lineNumber, string $line, NumberElement|SymbolElement ...$expectedElements): void
    {
        $parser = new EngineSchematicParser(new Lexer(EngineSchematicType::class));

        $this->assertEquals(
            new Elements(...$expectedElements),
            $parser->parse($lineNumber, $line)
        );
    }

    public static function lines(): iterable
    {
        $lineNumber = random_int(0, 100);

        yield [
            $lineNumber,
            '467..114..',
            new NumberElement($lineNumber, 0, 467),
            new NumberElement($lineNumber, 5, 114),
        ];

        yield [
            $lineNumber,
            '...*......',
            new SymbolElement($lineNumber, 3, '*'),
        ];

        yield [
            $lineNumber,
            '..35..633.',
            new NumberElement($lineNumber, 2, 35),
            new NumberElement($lineNumber, 6, 633),
        ];

        yield [
            $lineNumber,
            '......#...',
            new SymbolElement($lineNumber, 6, '#'),
        ];

        yield [
            $lineNumber,
            '17*......',
            new NumberElement($lineNumber, 0, 17),
            new SymbolElement($lineNumber, 2, '*'),
        ];

        yield [
            $lineNumber,
            '....+.58.',
            new SymbolElement($lineNumber, 4, '+'),
            new NumberElement($lineNumber, 6, 58),
        ];

        yield [
            $lineNumber,
            '..592.....',
            new NumberElement($lineNumber, 2, 592),
        ];

        yield [
            $lineNumber,
            '......755.',
            new NumberElement($lineNumber, 6, 755),
        ];

        yield [
            $lineNumber,
            '...$.*....',
            new SymbolElement($lineNumber, 3, '$'),
            new SymbolElement($lineNumber, 5, '*'),
        ];

        yield [
            $lineNumber,
            '.664.598..',
            new NumberElement($lineNumber, 1, 664),
            new NumberElement($lineNumber, 5, 598),
        ];
    }

}

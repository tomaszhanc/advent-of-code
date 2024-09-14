<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Unit\Day3;

use Advent\Shared\Grid\Cell;
use Advent\Year2023\Day3\EngineElementsParser;
use Advent\Year2023\Day3\EngineSchematic\Element;
use Advent\Year2023\Day3\EngineSchematic\Elements;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class EngineElementsParserTests extends TestCase
{
    #[Test] #[DataProvider('engine_schematic_lines')]
    public function test_parses_engine_schematic_lines(int $lineNumber, string $line, Element ...$expectedElements): void
    {
        $parser = new EngineElementsParser();

        $this->assertEquals(Elements::create(...$expectedElements), $parser->parse($lineNumber, $line));
    }

    public static function engine_schematic_lines(): iterable
    {
        yield [
            $lineNumber = 0,
            '467..114..',
            Element::number(new Cell(columnIndex: 0, rowIndex: $lineNumber), 467),
            Element::number(new Cell(columnIndex: 5, rowIndex: $lineNumber), 114),
        ];

        yield [
            $lineNumber = 1,
            '...*......',
            Element::symbol(new Cell(columnIndex: 3, rowIndex: $lineNumber), '*'),
        ];

        yield [
            $lineNumber = 2,
            '..35..633.',
            Element::number(new Cell(columnIndex: 2, rowIndex: $lineNumber), 35),
            Element::number(new Cell(columnIndex: 6, rowIndex: $lineNumber), 633),
        ];

        yield [
            $lineNumber = 3,
            '......#...',
            Element::symbol(new Cell(columnIndex: 6, rowIndex: $lineNumber), '#'),
        ];

        yield [
            $lineNumber = 4,
            '617*......',
            Element::number(new Cell(columnIndex: 0, rowIndex: $lineNumber), 617),
            Element::symbol(new Cell(columnIndex: 3, rowIndex: $lineNumber), '*'),
        ];

        yield [
            $lineNumber = 5,
            '.....+.58.',
            Element::symbol(new Cell(columnIndex: 5, rowIndex: $lineNumber), '+'),
            Element::number(new Cell(columnIndex: 7, rowIndex: $lineNumber), 58),
        ];

        yield [
            $lineNumber = 6,
            '..592.....',
            Element::number(new Cell(columnIndex: 2, rowIndex: $lineNumber), 592),
        ];

        yield [
            $lineNumber = 7,
            '......755.',
            Element::number(new Cell(columnIndex: 6, rowIndex: $lineNumber), 755),
        ];

        yield [
            $lineNumber = 8,
            '...$.*....',
            Element::symbol(new Cell(columnIndex: 3, rowIndex: $lineNumber), '$'),
            Element::symbol(new Cell(columnIndex: 5, rowIndex: $lineNumber), '*'),
        ];

        yield [
            $lineNumber = 9,
            '.664.598..',
            Element::number(new Cell(columnIndex: 1, rowIndex: $lineNumber), 664),
            Element::number(new Cell(columnIndex: 5, rowIndex: $lineNumber), 598),
        ];
    }
}

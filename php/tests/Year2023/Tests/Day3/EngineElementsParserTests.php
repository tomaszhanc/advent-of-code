<?php

declare(strict_types=1);

namespace AoC\Year2023\Tests\Day3;

use AoC\Common\Cell;
use AoC\Year2023\Day3\EngineSchematic\Element;
use AoC\Year2023\Day3\EngineSchematic\Elements;
use AoC\Year2023\Day3\EngineElementsParser;
use PHPUnit\Framework\TestCase;

final class EngineElementsParserTests extends TestCase
{
    /**
     * @dataProvider engine_schematic_lines
     */
    public function test_parses_engine_schematic_lines(int $lineNumber, string $line, Element ...$expectedElements): void
    {
        $parser = new EngineElementsParser();

        $this->assertEquals(Elements::create(...$expectedElements), $parser->parse($lineNumber, $line));
    }

    public static function engine_schematic_lines() : iterable
    {
        yield [
            $lineNumber = 0,
            '467..114..',
            Element::number(new Cell(column: 0, row: $lineNumber), 467),
            Element::number(new Cell(column: 5, row: $lineNumber), 114),
        ];

        yield [
            $lineNumber = 1,
            '...*......',
            Element::symbol(new Cell(column: 3, row: $lineNumber), '*'),
        ];

        yield [
            $lineNumber = 2,
            '..35..633.',
            Element::number(new Cell(column: 2, row: $lineNumber), 35),
            Element::number(new Cell(column: 6, row: $lineNumber), 633),
        ];

        yield [
            $lineNumber = 3,
            '......#...',
            Element::symbol(new Cell(column: 6, row: $lineNumber), '#'),
        ];

        yield [
            $lineNumber = 4,
            '617*......',
            Element::number(new Cell(column: 0, row: $lineNumber), 617),
            Element::symbol(new Cell(column: 3, row: $lineNumber), '*'),
        ];

        yield [
            $lineNumber = 5,
            '.....+.58.',
            Element::symbol(new Cell(column: 5, row: $lineNumber), '+'),
            Element::number(new Cell(column: 7, row: $lineNumber), 58),
        ];

        yield [
            $lineNumber = 6,
            '..592.....',
            Element::number(new Cell(column: 2, row: $lineNumber), 592),
        ];

        yield [
            $lineNumber = 7,
            '......755.',
            Element::number(new Cell(column: 6, row: $lineNumber), 755),
        ];

        yield [
            $lineNumber = 8,
            '...$.*....',
            Element::symbol(new Cell(column: 3, row: $lineNumber), '$'),
            Element::symbol(new Cell(column: 5, row: $lineNumber), '*'),
        ];

        yield [
            $lineNumber = 9,
            '.664.598..',
            Element::number(new Cell(column: 1, row: $lineNumber), 664),
            Element::number(new Cell(column: 5, row: $lineNumber), 598),
        ];
    }
}

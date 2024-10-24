<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day3\Model;

use Advent\Year2023\Day3\Model\Element\Elements;
use Advent\Year2023\Day3\Model\Element\NumberElement;
use Advent\Year2023\Day3\Model\Element\SymbolElement;
use Advent\Year2023\Day3\Model\PartNumber;
use Advent\Year2023\Day3\Model\PartNumbers;
use Advent\Year2023\Day3\Model\PartNumbersFactory;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PartNumbersFactoryTest extends TestCase
{
    #[Test]
    #[DataProvider('elements')]
    public function it_creates_part_numbers_from_elements(PartNumbers $expectedPartNumbers, Elements $elements): void
    {
        $factory = new PartNumbersFactory();

        $this->assertEquals($expectedPartNumbers, $factory->createFor($elements));
    }

    public static function elements(): iterable
    {
        yield 'one line, only numbers' => [
            new PartNumbers(),
            new Elements(
                new NumberElement(lineNumber: 0, position: 0, number: 467),
                new NumberElement(lineNumber: 0, position: 5, number: 114)
            ),
        ];

        yield 'one line, only symbols' => [
           new PartNumbers(),
           new Elements(
               new SymbolElement(lineNumber: 0, position: 3, symbol: '*'),
               new SymbolElement(lineNumber: 0, position: 6, symbol: '#')
           ),
        ];

        yield 'one line, not adjacent number and symbol' => [
            new PartNumbers(),
            new Elements(
                new NumberElement(lineNumber: 0, position: 0, number: 617),
                new SymbolElement(lineNumber: 0, position: 5, symbol: '*')
            ),
        ];

        yield 'one line, right adjacent' => [
            new PartNumbers(
                new PartNumber(617)
            ),
            new Elements(
                new NumberElement(lineNumber: 0, position: 0, number: 617),
                new SymbolElement(lineNumber: 0, position: 3, symbol: '*')
            ),
        ];

        yield 'one line, left adjacent' => [
            new PartNumbers(
                new PartNumber(617)
            ),
            new Elements(
                new SymbolElement(lineNumber: 0, position: 3, symbol: '*'),
                new NumberElement(lineNumber: 0, position: 4, number: 617),
            ),
        ];

        yield 'two lines, diagonal bottom-right adjacent' => [
            new PartNumbers(
                new PartNumber(467)
            ),
            new Elements(
                new NumberElement(lineNumber: 0, position: 0, number: 467),
                new NumberElement(lineNumber: 0, position: 5, number: 114),
                new SymbolElement(lineNumber: 1, position: 3, symbol: '*'),
            ),
        ];

        yield 'two lines, upper adjacent' => [
            new PartNumbers(
                new PartNumber(35)
            ),
            new Elements(
                new SymbolElement(lineNumber: 1, position: 3, symbol: '*'),
                new NumberElement(lineNumber: 2, position: 2, number: 35),
                new NumberElement(lineNumber: 2, position: 6, number: 633),
            ),
        ];

        yield 'two lines, bottom adjacent' => [
            new PartNumbers(
                new PartNumber(633)
            ),
            new Elements(
                new NumberElement(lineNumber: 2, position: 2, number: 35),
                new NumberElement(lineNumber: 2, position: 6, number: 633),
                new SymbolElement(lineNumber: 3, position: 7, symbol: '*'),
            ),
        ];

        yield 'two lines, adjacent with three symbols' => [
            new PartNumbers(
                new PartNumber(417),
                new PartNumber(417),
                new PartNumber(417),
            ),
            new Elements(
                new SymbolElement(lineNumber: 1, position: 7, symbol: '#'),
                new SymbolElement(lineNumber: 2, position: 5, symbol: '$'),
                new NumberElement(lineNumber: 2, position: 6, number: 417),
                new SymbolElement(lineNumber: 3, position: 7, symbol: '*'),
            ),
        ];
    }
}

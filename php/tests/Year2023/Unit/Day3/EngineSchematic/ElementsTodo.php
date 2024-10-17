<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Unit\Day3\EngineSchematic;

use Advent\Tests\Year2023\Mother\Day3\ElementMother;
use Advent\Year2023\Day3\EngineSchematic\Element;
use Advent\Year2023\Day3\EngineSchematic\Elements;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ElementsTodo extends TestCase
{
    #[DataProvider('adjacent_elements')]
    public function given_element_adjacent_to_symbol_element(Element $element, Elements $elements): void
    {
        $this->assertTrue($elements->isSymbolElementAdjacentTo($element));
    }

    public static function adjacent_elements(): iterable
    {
        $onlyNumberElements = Elements::create(
            ElementMother::symbol(x: 0, y: 2, symbol: '+'),
            ElementMother::symbol(x: 10, y: 2, symbol: '#'),
        );

        // the same Y-axis

        yield 'is adjacent to right side of "+" symbol' => [
            $onlyNumberElements,
            ElementMother::number(x: 1, y: 2),
        ];

        yield 'is adjacent to right side of "#" symbol' => [
            $onlyNumberElements,
            ElementMother::number(x: 11, y: 2),
        ];

        yield '1-digit number is adjacent to left side of "#" symbol' => [
            $onlyNumberElements,
            ElementMother::number(x: 9, y: 2, number: 7),
        ];

        yield '2-digit number is adjacent to left side of "#" symbol' => [
            $onlyNumberElements,
            ElementMother::number(x: 8, y: 2, number: 7),
        ];

        yield '3-digit number is adjacent to left side of "#" symbol' => [
            $onlyNumberElements,
            ElementMother::number(x: 7, y: 2, number: 7),
        ];


        // one level above of elements Y-axis


        // one level below of elements Y-axis
    }

    #[Test]
    #[DataProvider('not_adjacent_elements')]
    public function test_given_element_not_adjacent_to_symbol_element(Elements $elements, Element $element): void
    {
        $this->assertFalse($elements->isSymbolElementAdjacentTo($element));
    }

    public static function not_adjacent_elements(): iterable
    {
        $onlyNumberElements = Elements::create(
            ElementMother::number(x: 0, y: 2, number: 467),
            ElementMother::number(x: 10, y: 2, number: 114),
        );

        yield 'when it is too far in Y-axis' => [
            $onlyNumberElements,
            ElementMother::number(x: 0, y: 10),
        ];

        yield 'when it is too far in x-axis' => [
            $onlyNumberElements,
            ElementMother::number(x: 100, y: 2),
        ];

        yield 'when it is adjacent from left side, but to a number symbol' => [
            $onlyNumberElements,
            ElementMother::number(x: 3, y: 2), // adjacent to 467
        ];

        yield '[2 digits] when it is adjacent from right side, but to a number symbol' => [
            $onlyNumberElements,
            ElementMother::number(x: 8, y: 2, number: 23), // adjacent to 114
        ];

        yield '[3 digits] when it is adjacent from right side, but to a number symbol' => [
            $onlyNumberElements,
            ElementMother::number(x: 7, y: 2, number: 423), // adjacent to 114
        ];
    }


}

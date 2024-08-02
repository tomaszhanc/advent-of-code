<?php

declare(strict_types=1);

namespace AoC\Year2023\Tests\Day3;

use AoC\Common\Cell;
use AoC\Year2023\Day3\Bla;
use AoC\Year2023\Day3\EngineSchematic\Element;
use AoC\Year2023\Day3\EngineSchematic\Elements;
use AoC\Year2023\Tests\Mother\Day3\ElementMother;
use PHPUnit\Framework\TestCase;

final class BlaTest extends TestCase
{
    // fixme rename
    public function test_bla(): void
    {
        //            467..114..
        //            ...*......
        //            ..35..633.
        //            ......#...
        //            617*......
        //            .....+.58.
        //            ..592.....
        //            ......755.
        //            ...$.*....
        //            .664.598..

        // a może jednak przeparsuj stringa parserem by trdt był czytelniejszy?

        $elements = [
            Elements::create(
                $partNumber467 = ElementMother::number(x: 0, y: 0, number: 467),
                ElementMother::number(x: 5, y: 0, number: 114),
            ),
            Elements::create(
                ElementMother::symbol(x: 3, y: 1, symbol: '*'),
            ),
            Elements::create(
                $partNumber35 = ElementMother::number(x: 2, y: 2, number: 35),
                $partNumber633 = ElementMother::number(x: 6, y: 2, number: 633),
            ),
            Elements::create(
                ElementMother::symbol(x: 6, y: 3, symbol: '#'),
            ),
            Elements::create(
                $partNumber617 = ElementMother::number(x: 0, y: 4, number: 617),
                ElementMother::symbol(x: 3, y: 4, symbol: '*'),
            ),
            Elements::create(
                ElementMother::symbol(x: 5, y: 5, symbol: '+'),
                ElementMother::number(x: 7, y: 5, number: 58),
            ),
            Elements::create(
                $partNumber592 = ElementMother::number(x: 2, y: 6, number: 592),
            ),
            Elements::create(
                $partNumber755 = ElementMother::number(x: 6, y: 7, number: 755),
            ),
            Elements::create(
                ElementMother::symbol(x: 3, y: 8, symbol: '$'),
                ElementMother::symbol(x: 5, y: 8, symbol: '*'),
            ),
            Elements::create(
                $partNumber664 = ElementMother::number(x: 1, y: 9, number: 664),
                $partNumber598 = ElementMother::number(x: 5, y: 9, number: 598),
            ),
        ];

        $bla = Bla::create(...$elements);

        // 114 (top right) and 58 (middle right) nie sasiaduja z partami, wiec nie wliczane sa do sumy
        // Every other number is adjacent to a symbol and so is a part number;
        // their sum is 4361.

        $this->assertEquals(
            [
                $partNumber467,
                $partNumber35,
                $partNumber633,
                $partNumber617,
                $partNumber592,
                $partNumber755,
                $partNumber664,
                $partNumber598,
            ],
            $bla->foo()
        );
    }
}

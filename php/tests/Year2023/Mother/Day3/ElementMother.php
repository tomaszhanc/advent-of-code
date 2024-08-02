<?php

declare(strict_types=1);

namespace AoC\Year2023\Tests\Mother\Day3;

use AoC\Common\Cell;
use AoC\Year2023\Day3\EngineSchematic\Element;

final readonly class ElementMother
{
    public static function symbol(int $x, int $y, string $symbol = '*'): Element
    {
        return Element::symbol(new Cell($x, $y), $symbol);
    }

    public static function number(int $x, int $y, int $number = null): Element
    {
        return Element::number(new Cell($x, $y), $number ?? \random_int(10, 999));
    }
}

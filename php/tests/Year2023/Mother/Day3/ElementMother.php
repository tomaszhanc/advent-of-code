<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Mother\Day3;

use Advent\Shared\Grid\Location;
use Advent\Year2023\Day3\Legacy\EngineSchematic\Element;

final readonly class ElementMother
{
    public static function symbol(int $x, int $y, string $symbol = '*'): Element
    {
        return Element::symbol(new Location($x, $y), $symbol);
    }

    public static function number(int $x, int $y, int $number = null): Element
    {
        return Element::number(new Location($x, $y), $number ?? \random_int(10, 999));
    }
}

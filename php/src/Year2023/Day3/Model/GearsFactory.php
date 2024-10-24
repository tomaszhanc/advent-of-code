<?php

declare(strict_types=1);

namespace Advent\Year2023\Day3\Model;

use Advent\Year2023\Day3\Model\Element\Elements;

final readonly class GearsFactory
{
    public function createFor(Elements $elements): Gears
    {
        $gears = [];

        foreach ($elements->symbolElements('*') as $symbolElement) {
            $adjacentPartNumbers = [];

            foreach ($elements->numberElements() as $numberElement) {
                if ($numberElement->isAdjacentTo($symbolElement)) {
                    $adjacentPartNumbers[] = $numberElement->number;
                }
            }

            if (\count($adjacentPartNumbers) === 2) {
                $gears[] = new Gear(...$adjacentPartNumbers);
            }
        }

        return new Gears(...$gears);
    }
}

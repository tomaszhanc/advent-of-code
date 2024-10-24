<?php

declare(strict_types=1);

namespace Advent\Year2023\Day3\Model;

use Advent\Year2023\Day3\Model\Element\Elements;

final readonly class PartNumbersFactory
{
    public function createFor(Elements $elements): PartNumbers
    {
        $partNumbers = [];

        foreach ($elements->numberElements() as $numberElement) {
            foreach ($elements->symbolElements() as $symbolElement) {
                if ($numberElement->isAdjacentTo($symbolElement)) {
                    $partNumbers[] = new PartNumber($numberElement->number);
                }
            }
        }

        return new PartNumbers(...$partNumbers);
    }
}

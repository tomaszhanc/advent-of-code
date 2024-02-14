<?php

declare(strict_types=1);

namespace AoC\Year2023\Day3\EngineSchematic;

use AoC\Common\InvalidArgumentException;

final readonly class PartNumber
{
    public function __construct(public Element $element)
    {
        if (!$element->isNumber()) {
            throw InvalidArgumentException::because('Element must be a number. Given: %s', $element->type->name);
        }
    }
}

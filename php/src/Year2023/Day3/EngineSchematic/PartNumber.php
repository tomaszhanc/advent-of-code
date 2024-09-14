<?php

declare(strict_types=1);

namespace Advent\Year2023\Day3\EngineSchematic;

use Advent\Shared\Grid\InvalidArgumentException;

final readonly class PartNumber
{
    public function __construct(public Element $element)
    {
        if (!$element->isNumber()) {
            throw InvalidArgumentException::because('Element must be a number. Given: %s', $element->type->name);
        }
    }
}

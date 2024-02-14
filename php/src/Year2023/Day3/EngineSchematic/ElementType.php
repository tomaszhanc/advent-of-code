<?php

declare(strict_types=1);

namespace AoC\Year2023\Day3\EngineSchematic;

enum ElementType
{
    case Symbol;
    case SomeNumber;

    case PartNumber;
    case NotPartNumber;
}

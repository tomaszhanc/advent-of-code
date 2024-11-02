<?php

declare(strict_types=1);

namespace Advent\Year2023\Day6\Parser;

use Advent\Shared\Lexer\Attributes\Regex;

enum RaceLogType
{
    #[Regex('Time')]
    case TIME;

    #[Regex('Distance')]
    case DISTANCE;

    #[Regex('\d+')]
    case NUMBER;

    #[Regex('\n')]
    case NEW_LINE;
}

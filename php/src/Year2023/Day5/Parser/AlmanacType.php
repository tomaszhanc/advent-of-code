<?php

declare(strict_types=1);

namespace Advent\Year2023\Day5\Parser;

use Advent\Shared\Lexer\Attributes\Regex;

enum AlmanacType
{
    #[Regex('seeds')]
    case SEEDS;

    #[Regex('[a-z,-]+ map')]
    case MAP;

    #[Regex('\d+')]
    case NUMBER;

    #[Regex('\n')]
    case NEW_LINE;
}

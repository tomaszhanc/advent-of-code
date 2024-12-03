<?php

declare(strict_types=1);

namespace Advent\Year2024\Day3\Parser;

use Advent\Shared\Lexer\Attributes\Regex;

enum MemoryType
{
    #[Regex('mul\(\d+,\d+\)')]
    case MUL;

    #[Regex('do\(\)')]
    case DO;

    #[Regex('don\'t\(\)')]
    case DONT;
}

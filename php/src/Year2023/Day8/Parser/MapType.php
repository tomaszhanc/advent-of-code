<?php

declare(strict_types=1);

namespace Advent\Year2023\Day8\Parser;

use Advent\Shared\Lexer\Attributes\Regex;

enum MapType
{
    #[Regex('[A-Z]{3}')]
    case NODE;

    #[Regex('\n')]
    case NEW_LINE;

    #[Regex('=')]
    case EQUALS_SIGN;
}

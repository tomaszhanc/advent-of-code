<?php

declare(strict_types=1);

namespace Advent\Year2023\Day8\Parser;

use Advent\Shared\Lexer\Attributes\Regex;

enum InstructionsType
{
    #[Regex('R|L')]
    case MOVE;
}

<?php

declare(strict_types=1);

namespace Advent\Year2023\Day10\Parser;

use Advent\Shared\Lexer\Attributes\Regex;

enum PipeType
{
    #[Regex('S')]
    case START;

    #[Regex('\||\-|L|J|F|7')]
    case PIPE;
}

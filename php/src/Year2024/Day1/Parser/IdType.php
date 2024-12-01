<?php

declare(strict_types=1);

namespace Advent\Year2024\Day1\Parser;

use Advent\Shared\Lexer\Attributes\Regex;

enum IdType
{
    #[Regex('\d+')]
    case NUMBER;
}

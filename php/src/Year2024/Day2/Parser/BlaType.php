<?php

declare(strict_types=1);

namespace Advent\Year2024\Day2\Parser;

use Advent\Shared\Lexer\Attributes\Regex;

enum BlaType
{
    #[Regex('Game')]
    case GAME;

    #[Regex('\d+')]
    case NUMBER;

    #[Regex('red|green|blue')]
    case COLOR;

    #[Regex(';')]
    case SEMICOLON;

    #[Regex('\*|\#|\+|\$|\-|\/|\@|\%|\=|\&')]
    case SYMBOL;
}

<?php

declare(strict_types=1);

namespace Advent\Year2023\Day2\Parser;

use Advent\Shared\Lexer\Attributes\Regex;

enum GameTokenType
{
    #[Regex('Game')]
    case GAME;

    #[Regex('\d+')]
    case NUMBER;

    #[Regex('red|green|blue')]
    case COLOR;

    #[Regex(';')]
    case SEMICOLON;
}

<?php

declare(strict_types=1);

namespace AoC\Year2023\Day2\Lexer;

enum Type
{
    case T_NONE;
    case T_GAME;
    case T_COLOR;
    case T_NUMBER;
    case T_SEMICOLON;
}

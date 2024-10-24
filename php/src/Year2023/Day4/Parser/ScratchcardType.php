<?php

declare(strict_types=1);

namespace Advent\Year2023\Day4\Parser;

use Advent\Shared\Lexer\Attributes\Regex;

enum ScratchcardType
{
    #[Regex('Card')]
    case CARD;

    #[Regex('\d+')]
    case NUMBER;

    #[Regex('\|')]
    case BAR;
}

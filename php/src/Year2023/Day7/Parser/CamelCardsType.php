<?php

declare(strict_types=1);

namespace Advent\Year2023\Day7\Parser;

use Advent\Shared\Lexer\Attributes\Regex;

enum CamelCardsType
{
    #[Regex('\d|T|J|Q|K|A')]
    case CARD_OR_NUMBER;

    #[Regex(' ')]
    case SPACE;
}

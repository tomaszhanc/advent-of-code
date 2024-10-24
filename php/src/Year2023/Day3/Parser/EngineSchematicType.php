<?php

declare(strict_types=1);

namespace Advent\Year2023\Day3\Parser;

use Advent\Shared\Lexer\Attributes\Regex;

enum EngineSchematicType
{
    #[Regex('\d+')]
    case NUMBER;

    #[Regex('\*|\#|\+|\$|\-|\/|\@|\%|\=|\&')]
    case SYMBOL;
}

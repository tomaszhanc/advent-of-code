<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Draw\SVG;

enum NodeType
{
    case RECTANGLE;

    case LINE_UP_DOWN;
    case LINE_UP_RIGHT;
    case LINE_UP_LEFT;
    case LINE_LEFT_RIGHT;
    case LINE_DOWN_RIGHT;
    case LINE_DOWN_LEFT;
}

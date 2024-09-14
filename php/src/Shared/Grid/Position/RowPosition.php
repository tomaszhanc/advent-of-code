<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Position;

enum RowPosition
{
    case ABOVE;
    case BELOW;
    case SAME;
    case DETACHED;

    public function isAbove(): bool
    {
        return $this === self::ABOVE;
    }

    public function isBelow(): bool
    {
        return $this === self::BELOW;
    }

    public function isSame(): bool
    {
        return $this === self::SAME;
    }

    public function isDetached(): bool
    {
        return $this === self::DETACHED;
    }
}

<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Position;

enum ColumnPosition
{
    case LEFT;
    case RIGHT;
    case SAME;
    case DETACHED;

    public function isLeft(): bool
    {
        return $this === self::LEFT;
    }

    public function isRight(): bool
    {
        return $this === self::RIGHT;
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

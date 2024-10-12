<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Adjacency;

enum ColumnAdjacency
{
    case LEFT;
    case RIGHT;
    case SAME;
    case DISTANT;

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

    public function isDistant(): bool
    {
        return $this === self::DISTANT;
    }
}

<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Adjacency;

enum RowAdjacency
{
    case ABOVE;
    case BELOW;
    case SAME;
    case DISTANT;

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

    public function isDistant(): bool
    {
        return $this === self::DISTANT;
    }
}

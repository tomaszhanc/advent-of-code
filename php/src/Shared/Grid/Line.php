<?php

declare(strict_types=1);

namespace Advent\Shared\Grid;

interface Line
{
    public function isAdjacentTo(Cell $cell): bool;

    /**
     * @return Cell[]
     */
    public function cells(): iterable;
}

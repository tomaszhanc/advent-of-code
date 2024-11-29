<?php

declare(strict_types=1);

namespace Advent\Shared\Grid;

interface Line
{
    public function isAdjacentTo(Location $location): bool;

    /**
     * @return Location[]
     */
    public function cells(): iterable;
}

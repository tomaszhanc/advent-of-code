<?php

declare(strict_types=1);

namespace Advent\Shared\Grid;

/**
 * @template T implements string|\Stringable
 */
interface Cell
{
    public function location(): Location;

    /** @return T */
    public function value(): string|\Stringable;
}

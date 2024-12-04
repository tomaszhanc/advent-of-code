<?php

declare(strict_types=1);

namespace Advent\Shared\Grid;

interface Cell
{
    public function location(): Location;
}

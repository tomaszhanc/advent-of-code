<?php

declare(strict_types=1);

namespace Advent\Shared\Grid;

interface GridCell
{
    public function location(): Location;
}

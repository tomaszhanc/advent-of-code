<?php

declare(strict_types=1);

namespace Advent\Year2023\Day10\Model\Grid;

use Advent\Shared\Grid\GridCell;
use Advent\Shared\Grid\Location;
use Advent\Year2023\Day10\Model\Pipe;

final readonly class GridCellPipeAdapter implements GridCell
{
    public function __construct(
        public Pipe $pipe
    ) {
    }

    public function location(): Location
    {
        return $this->pipe->location();
    }
}

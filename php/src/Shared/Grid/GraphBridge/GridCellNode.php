<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\GraphBridge;

use Advent\Shared\Graph\Node;
use Advent\Shared\Grid\Cell;

final readonly class GridCellNode implements Node
{
    public function __construct(
        private Cell $cell
    ) {
    }

    public function id(): string
    {
        return $this->cell->location()->toString();
    }
}

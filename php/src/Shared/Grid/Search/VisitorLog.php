<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Search;

use Advent\Shared\Grid\GridCell;

final class VisitorLog
{
    private array $visited = [];

    public function markAsVisited(GridCell $cell): void
    {
        $this->visited[$cell->location()->toString()] = true;
    }

    public function isVisited(GridCell $cell): bool
    {
        return $this->visited[$cell->location()->toString()] ?? false;
    }
}

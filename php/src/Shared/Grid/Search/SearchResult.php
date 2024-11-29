<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Search;

use Advent\Shared\Grid\GridCell;

final readonly class SearchResult
{
    public function __construct(
        private GridCell $cell,
        private int $distance
    ) {
    }

    public function cell(): GridCell
    {
        return $this->cell;
    }

    public function distance(): int
    {
        return $this->distance;
    }
}

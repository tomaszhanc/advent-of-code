<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Search;

use Advent\Shared\Grid\GridCell;
use Advent\Shared\Grid\InvalidArgumentException;

final readonly class Path
{
    /**
     * @param GridCell[] $cells
     */
    private function __construct(
        public array $cells,
        private int   $distance
    ) {
        if (count($cells) === 0) {
            throw new InvalidArgumentException('Path must contain at least one cell');
        }
    }

    public static function startFrom(GridCell $startingCell): self
    {
        return new self([$startingCell], distance: 0);
    }

    public function has(GridCell $cell): bool
    {
        return in_array($cell, $this->cells);
    }

    public function lastCell(): GridCell
    {
        return $this->cells[array_key_last($this->cells)];
    }

    public function distance(): int
    {
        return $this->distance;
    }

    public function addStep(GridCell $cell, int $distance): self
    {
        return new self(
            [...$this->cells, $cell],
            $this->distance + $distance
        );
    }
}

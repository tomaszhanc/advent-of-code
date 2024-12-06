<?php

declare(strict_types=1);

namespace Advent\Year2024\Day6\Model\Grid;

use Advent\Shared\Grid\Cell;
use Advent\Shared\InvalidArgumentException;

final readonly class Path
{
    /** @param Cell[] $cells */
    private function __construct(
        public array $cells,
        private int $distance
    ) {
        if (count($cells) === 0) {
            throw new InvalidArgumentException('A Path must include at least one Node.');
        }
    }

    public static function startFrom(Cell $cell): self
    {
        return new self([$cell], distance: 0);
    }

    public function contains(Cell $cell): bool
    {
        return in_array($cell, $this->cells);
    }

    public function distinctPositions(): int
    {
        return count(
            array_unique(
                array_map(
                    fn (Cell $cell) => $cell->location()->toString(),
                    $this->cells,
                )
            )
        );
    }

    public function distance(): int
    {
        return $this->distance;
    }

    public function addStep(Cell $cell, int $stepDistance = 1): self
    {
        return new self(
            [...$this->cells, $cell],
            $this->distance + $stepDistance
        );
    }
}

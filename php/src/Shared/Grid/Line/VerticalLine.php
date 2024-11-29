<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Line;

use Advent\Shared\Grid\Location;
use Advent\Shared\Grid\InvalidArgumentException;
use Advent\Shared\Grid\Line;

final readonly class VerticalLine implements Line
{
    public function __construct(
        public Location $startCell,
        public Location $endCell
    ) {
        if ($this->startCell->x !== $this->endCell->x) {
            throw InvalidArgumentException::because('Vertical line must have cells in the same column');
        }

        if ($startCell->equalsTo($endCell)) {
            throw InvalidArgumentException::because('Vertical line cannot start and end on the same cell');
        }

        if ($startCell->y > $endCell->y) {
            throw InvalidArgumentException::because('Start cell must be before end cell');
        }
    }

    public static function ofLength(Location $startCell, int $length): self
    {
        return new self(
            $startCell,
            new Location($startCell->x, $startCell->y + $length - 1)
        );
    }

    public function isAdjacentTo(Location $location): bool
    {
        $startCell = $this->startCell->adjacencyTo($location);
        $endCell = $this->endCell->adjacencyTo($location);

        if ($startCell->isDirectlyBelow() || $endCell->isDirectlyAbove()) {
            return true;
        }

        if ($startCell->isColumnAdjacent()) {
            return $location->y >= $this->startCell->y - 1
                && $location->y <= $this->endCell->y + 1;
        }

        return false;
    }

    public function cells(): iterable
    {
        foreach (range($this->startCell->y, $this->endCell->y) as $rowIndex) {
            yield new Location($this->startCell->x, $rowIndex);
        }
    }
}

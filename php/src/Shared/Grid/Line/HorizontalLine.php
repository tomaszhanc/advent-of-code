<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Line;

use Advent\Shared\Grid\Location;
use Advent\Shared\Grid\InvalidArgumentException;
use Advent\Shared\Grid\Line;

final readonly class HorizontalLine implements Line
{
    public function __construct(
        public Location $start,
        public Location $end
    ) {
        if ($start->y !== $end->y) {
            throw InvalidArgumentException::because('Horizontal line must have cells in the same row');
        }

        if ($start->equalsTo($end)) {
            throw InvalidArgumentException::because('Horizontal line cannot start and end on the same cell');
        }

        if ($start->x > $end->x) {
            throw InvalidArgumentException::because('Start cell must be before end cell');
        }
    }

    public static function ofLength(Location $startCell, int $length): self
    {
        return new self(
            $startCell,
            new Location($startCell->x + $length - 1, $startCell->y)
        );
    }

    public function isAdjacentTo(Location $location): bool
    {
        $startCell = $this->start->adjacencyTo($location);
        $endCell = $this->end->adjacencyTo($location);

        if ($startCell->isDirectlyRight() || $endCell->isDirectlyLeft()) {
            return true;
        }

        if ($startCell->isRowAdjacent()) {
            return $location->x >= $this->start->x - 1
                && $location->x <= $this->end->x + 1;
        }

        return false;
    }

    public function cells(): iterable
    {
        foreach (range($this->start->x, $this->end->x) as $columnIndex) {
            yield new Location($columnIndex, $this->start->y);
        }
    }
}

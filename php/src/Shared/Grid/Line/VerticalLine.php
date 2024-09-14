<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Line;

use Advent\Shared\Grid\Cell;
use Advent\Shared\Grid\InvalidArgumentException;
use Advent\Shared\Grid\Line;

final readonly class VerticalLine implements Line
{
    public function __construct(
        public Cell $startCell,
        public Cell $endCell
    ) {
        if ($this->startCell->columnIndex !== $this->endCell->columnIndex) {
            throw InvalidArgumentException::because('Vertical line must have cells in the same column');
        }

        if ($startCell->equals($endCell)) {
            throw InvalidArgumentException::because('Vertical line cannot start and end on the same cell');
        }

        if ($startCell->rowIndex > $endCell->rowIndex) {
            throw InvalidArgumentException::because('Start cell must be before end cell');
        }
    }

    public static function ofLength(Cell $startCell, int $length): self
    {
        return new self(
            $startCell,
            new Cell($startCell->columnIndex, $startCell->rowIndex + $length)
        );
    }

    public function isAdjacentTo(Cell $cell): bool
    {
        return AdjacencyChecker::forVerticalLine($this, $cell)->isAdjacent();  // todo przenieśc logike z adjency checkera
    }
}

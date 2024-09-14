<?php

declare(strict_types=1);

namespace Advent\Shared\Grid\Line;

use Advent\Shared\Grid\Cell;
use Advent\Shared\Grid\InvalidArgumentException;
use Advent\Shared\Grid\Line;

final readonly class HorizontalLine implements Line
{
    public function __construct(
        public Cell $startCell,
        public Cell $endCell
    ) {
        if ($startCell->rowIndex !== $endCell->rowIndex) {
            throw InvalidArgumentException::because('Horizontal line must have cells in the same row');
        }

        if ($startCell->equals($endCell)) {
            throw InvalidArgumentException::because('Horizontal line cannot start and end on the same cell');
        }

        if ($startCell->columnIndex > $endCell->columnIndex) {
            throw InvalidArgumentException::because('Start cell must be before end cell');
        }
    }

    public static function ofLength(Cell $startCell, int $length): self
    {
        return new self(
            $startCell,
            new Cell($startCell->columnIndex + $length, $startCell->rowIndex)
        );
    }

    public function isAdjacentTo(Cell $cell): bool
    {
        return AdjacencyChecker::forHorizontalLine($this, $cell)->isAdjacent(); // todo przenieśc logike z adjency checkera
    }
}

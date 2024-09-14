<?php

declare(strict_types=1);

namespace Advent\Shared\Grid;

use Advent\Shared\Parser\InvalidArgumentException;

final readonly class Line
{
    public function __construct(
        public Cell $startCell,
        public Cell $endCell
    ) {
        if ($startCell->columnIndex > $endCell->columnIndex) {
            throw InvalidArgumentException::because('Line start cell column must be less than or equal to line end cell column');
        }

        if ($startCell->columnIndex !== $endCell->columnIndex && $startCell->rowIndex !== $endCell->rowIndex) {
            throw InvalidArgumentException::because('Diagonal lines are not supported');
        }
    }

    public static function horizontal(Cell $startCell, int $length): self
    {
        return new self($startCell, $startCell);
    }

    public static function vertical(Cell $startCell, int $length): self
    {
        return new self($startCell, $startCell);
    }

    public function isAdjacentTo(Cell $cell): bool
    {
        if ($this->startCell->rowIndex === $this->endCell->rowIndex) {
            return AdjacencyChecker::forHorizontalLine($this, $cell)->isAdjacent();
        }

        return AdjacencyChecker::forVerticalLine($this, $cell)->isAdjacent();
    }
}
